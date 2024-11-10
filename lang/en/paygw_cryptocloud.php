<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'paygw_cryptocloud', language 'en'
 *
 * @package    paygw_cryptocloud
 * @copyright  2024 Alex Orlov <snickser@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['abouttopay'] = 'You are about to pay for';
$string['apikey'] = 'API Key';
$string['callback_help'] = 'Copy this lines and paste it into the cryptocloud project settings. Switch off "My project on CMS".';
$string['callback_url'] = 'Notification URL:';
$string['cryptocurrency'] = 'Allowed cryptocurrency';
$string['fixcost'] = 'Fixed price mode';
$string['fixcost_help'] = 'Disables the ability for students to pay with an arbitrary amount.';
$string['fixdesc'] = 'Fixed payment comment';
$string['fixdesc_help'] = 'This setting sets a fixed comment for all payments.';
$string['gatewaydescription'] = 'CryptoCloud — a reliable way to easily and conveniently accept payments from around the world in the most popular cryptocurrencies.';
$string['gatewayname'] = 'CryptoCloud';
$string['internalerror'] = 'An internal error has occurred. Please contact us.';
$string['istestmode'] = 'Test mode';
$string['maxcost'] = 'Maximium cost';
$string['maxcosterror'] = 'The maximum price must be higher than the recommended price';
$string['message_invoice_created'] = 'Hello {$a->firstname}!
Your payment link {$a->orderid} to {$a->fee} {$a->currency} has been successfully created.
You can pay it within an hour.';
$string['message_success_completed'] = 'Hello {$a->firstname},
You transaction of payment id {$a->orderid} with cost of {$a->fee} {$a->currency} is successfully completed.
If the item is not accessable please contact the administrator.';
$string['messageprovider:payment_receipt'] = 'Payment receipt';
$string['messagesubject'] = 'Payment notification';
$string['password'] = 'Password';
$string['password_error'] = 'Invalid payment password';
$string['password_help'] = 'Using this password you can bypass the payback process. It can be useful when it is not possible to make a payment.';
$string['password_success'] = 'Paymemt password accepted';
$string['password_text'] = 'If you are unable to make a payment, then ask your curator for a password and enter it.';
$string['passwordmode'] = 'Password';
$string['payment'] = 'Donation';
$string['payment_error'] = 'Payment Error';
$string['payment_success'] = 'Payment Successful';
$string['paymore'] = 'If you want to donate more, simply enter your amount instead of the indicated amount.';
$string['pluginname'] = 'CryptoCloud payment';
$string['pluginname_desc'] = 'The cryptocloud plugin allows you to receive payments via CryptoCloud.';
$string['privacy:metadata'] = 'The cryptocloud plugin store some personal data.';
$string['privacy:metadata:paygw_cryptocloud:apikey'] = 'ApiKey';
$string['privacy:metadata:paygw_cryptocloud:courceid'] = 'Cource id';
$string['privacy:metadata:paygw_cryptocloud:cryptocloud_plus'] = 'Send json data';
$string['privacy:metadata:paygw_cryptocloud:email'] = 'Email';
$string['privacy:metadata:paygw_cryptocloud:groupnames'] = 'Group names';
$string['privacy:metadata:paygw_cryptocloud:invoiceid'] = 'Invoice id';
$string['privacy:metadata:paygw_cryptocloud:paygw_cryptocloud'] = 'Store some data';
$string['privacy:metadata:paygw_cryptocloud:shopid'] = 'Shopid';
$string['privacy:metadata:paygw_cryptocloud:success'] = 'Status';
$string['return_url'] = 'SuccessURL and FailURL:';
$string['secretkey'] = 'Secret key';
$string['sendpaymentbutton'] = 'Send payment via cryptocloud!';
$string['shopid'] = 'ShopID';
$string['showduration'] = 'Show duration of training';
$string['skipmode'] = 'Can skip payment';
$string['skipmode_help'] = 'This setting allows a payment bypass button, which can be useful in public courses with optional payment.';
$string['skipmode_text'] = 'If you are not able to make a donation through the payment system, you can click on this button.';
$string['skippaymentbutton'] = 'Skip payment :(';
$string['suggest'] = 'Suggested cost';
$string['usedetails'] = 'Make it collapsible';
$string['usedetails_help'] = 'Display a button or password in a collapsed block.';
$string['usedetails_text'] = 'Click here if you are unable to donate.';
$string['donate'] = '<div>Версия плагина: {$a->release} ({$a->versiondisk})<br>
Новые версии плагина вы можете найти на <a href=https://github.com/Snickser/moodle-paygw_cryptocloud>GitHub.com</a>
<img src="https://img.shields.io/github/v/release/Snickser/moodle-paygw_cryptocloud.svg"><br>
Пожалуйста, отправьте мне немножко <a href="https://yoomoney.ru/fundraise/143H2JO3LLE.240720">доната</a>😊</div>
<iframe src="https://yoomoney.ru/quickpay/fundraise/button?billNumber=143H2JO3LLE.240720"
width="330" height="50" frameborder="0" allowtransparency="true" scrolling="no"></iframe>';
