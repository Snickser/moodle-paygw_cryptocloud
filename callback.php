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
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require("../../../config.php");
global $CFG, $USER, $DB;

defined('MOODLE_INTERNAL') || die();

$status         = required_param('status', PARAM_TEXT);
$invoiceid      = required_param('invoice_id', PARAM_TEXT);
$amountcrypto   = required_param('amount_crypto', PARAM_TEXT);
$currency       = required_param('currency', PARAM_TEXT);
$orderid        = required_param('order_id', PARAM_INT);
$token          = required_param('token', PARAM_TEXT);

if ($status !== 'success') {
    die('FAIL. Payment not successed.');
}

if (!$cryptocloudtx = $DB->get_record('paygw_cryptocloud', [ 'paymentid' => $orderid, 'invoiceid' => 'INV-' . $invoiceid ])) {
    die('FAIL. Not a valid transaction.');
}

if (!$payment = $DB->get_record('payments', ['id' => $cryptocloudtx->paymentid])) {
    die('FAIL. Not a valid payment.');
}
$component   = $payment->component;
$paymentarea = $payment->paymentarea;
$itemid      = $payment->itemid;
$paymentid   = $payment->id;
$userid      = $payment->userid;

// Get secretkey.
$config = (object) helper::get_gateway_configuration($component, $paymentarea, $itemid, 'cryptocloud');

$decoded = JWT::decode($token, new Key($config->secretkey, 'HS256'));
if (empty($decoded->id)) {
    die('FAIL. Invalid token.');
}

helper::deliver_order($component, $paymentarea, $itemid, $paymentid, $userid);

// Write to DB.
$cryptocloudtx->success = 1;
if (!$DB->update_record('paygw_cryptocloud', $cryptocloudtx)) {
    die('FAIL. Update db error.');
} else {
    echo json_encode(['message' => 'Postback received']);
}
