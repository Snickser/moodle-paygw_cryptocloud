[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://paypal.me/snickser) support me with a donation.

## CryptoCloud payment gateway plugin for Moodle.

v0.12

https://cryptocloud.plus/

![img](https://github.com/Snickser/moodle-paygw_cryptocloud/blob/main/pix/img.svg)

## Status

[![Build Status](https://github.com/Snickser/moodle-paygw_cryptocloud/actions/workflows/moodle-ci.yml/badge.svg)](https://github.com/Snickser/moodle-paygw_cryptocloud/actions/workflows/moodle-ci.yml)

## Recommendations

+ Moodle 4.3+
+ To enroll in the course, use my patched plugin "Enrollment for payment" [enrol_fee](https://github.com/Snickser/moodle-enrol_fee/tree/dev).
+ For the control task, use the plugin I patched at the link [mod_gwpayments](https://github.com/Snickser/moodle-mod_gwpayments/tree/dev).
+ To limit availability, use the plugin I patched at the link [availability_gwpayments](https://github.com/Snickser/moodle-availability_gwpayments/tree/dev).
+ Plugin for viewing reports [report_payments](https://github.com/Snickser/moodle-report_payments/tree/dev).

## INSTALLATION

Download the latest **paygw_cryptocloud.zip** and unzip the contents into the **/payment/gateway** directory. Or upload it from Moodle plugins adminnistration interface.

1. Install the plugin
2. Enable the cryptocloud payment gateway
3. Create a new payment account
4. Configure the payment account against the cryptocloud gateway using your pay ID
5. Enable the 'Enrolment on Payment' enrolment method
6. Add the 'Enrolment on Payment' method to your chosen course
7. Set the payment account, enrolment fee, and currency

This plugin supports only basic functionality, but everything changes someday...
