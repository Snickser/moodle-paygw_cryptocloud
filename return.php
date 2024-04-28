<?php

use core_payment\helper;

require("../../../config.php");
global $CFG, $USER, $DB;

defined('MOODLE_INTERNAL') || die();

require_login();

// file_put_contents("/tmp/xxxx", serialize($_REQUEST)."\n", FILE_APPEND);

$id = required_param('order_id', PARAM_INT);

if (!$cryptocloudtx = $DB->get_record('paygw_cryptocloud', ['id' => $id])) {
    die('FAIL. Not a valid transaction id');
}

$paymentarea = $cryptocloudtx->paymentarea;
$component   = $cryptocloudtx->component;
$itemid      = $cryptocloudtx->itemid;

$url = helper::get_success_url($component, $paymentarea, $itemid);
if ($cryptocloudtx->success) {
    redirect($url, get_string('payment_success', 'paygw_cryptocloud'), 0, 'success');
} else {
    redirect($url, get_string('payment_error', 'paygw_cryptocloud'), 0, 'error');
}
