<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin administration pages are defined here.
 *
 * @package     paygw_cryptocloud
 * @copyright   2024 Alex Orlov <snickser@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core_payment\helper;

require("../../../config.php");
global $CFG, $USER, $DB;

defined('MOODLE_INTERNAL') || die();

$source = file_get_contents('php://input');

$data = [];
parse_str($source, $data);

// file_put_contents("/tmp/yyyyy", serialize($data) . "\n", FILE_APPEND);

$status = $data['status'] ?? null;
$invoiceid = $data['invoice_id'] ?? null;
$amountcrypto = $data['amount_crypto'] ?? null;
$currency = $data['currency'] ?? null;
$orderid = $data['order_id'] ?? null;
$token = $data['token'] ?? null;

if ($status !== 'success') {
    die('FAIL. Payment not successed.');
}

if (!$cryptocloudtx = $DB->get_record('paygw_cryptocloud', [ 'id' => $orderid, 'invoiceid' => 'INV-' . $invoiceid ])) {
    die('FAIL. Not a valid transaction id');
}

if (! $userid = $DB->get_record("user", ["id" => $cryptocloudtx->userid])) {
    die('FAIL. Not a valid user id.');
}

$component   = $cryptocloudtx->component;
$paymentarea = $cryptocloudtx->paymentarea;
$itemid      = $cryptocloudtx->itemid;
$userid      = $cryptocloudtx->userid;

// Get config apikey.
$config = (object) helper::get_gateway_configuration($component, $paymentarea, $itemid, 'cryptocloud');

// Get invoice data from cryptocloud.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.cryptocloud.plus/v2/invoice/merchant/info");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
    "uuids" => array($invoiceid)
)));
$headers = array(
    "Authorization: Token " . $config->apikey,
    "Content-Type: application/json"
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$jsonresponse = curl_exec($ch);
if (curl_errno($ch)) {
    die('Error: ' . curl_error($ch));
} else {
    $statuscode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($statuscode !== 200) {
        die('FAIL: ' . $statuscode . " " . $response);
    }
}
curl_close($ch);

$response = json_decode($jsonresponse, false);

// file_put_contents("/tmp/yyyyy", serialize($response->result) . "\n", FILE_APPEND);

// Check invoice status.
if ($response->status !== 'success') {
    die('FAIL. Invoice check not successed.');
}
if ($response->result[0]->invoice_status !== 'success'){
    die('FAIL. Invoice not successed.');
}
if ($response->result[0]->status !== 'paid'){
    die('FAIL. Invoice not paid.');
}

// Get config.
$payable = helper::get_payable($component, $paymentarea, $itemid);

// Deliver course.
$paymentid = helper::save_payment(
    $payable->get_account_id(),
    $component,
    $paymentarea,
    $itemid,
    $userid,
    $cryptocloudtx->cost,
    $payable->get_currency(),
    'cryptocloud'
);
helper::deliver_order($component, $paymentarea, $itemid, $paymentid, $userid);

// Write to DB.
$cryptocloudtx->success = 1;
$cryptocloudtx->timemodified = time();
if (!$DB->update_record('paygw_cryptocloud', $cryptocloudtx)) {
    die('FAIL. Update db error.');
} else {
    echo json_encode(['message' => 'Postback received']);
}
