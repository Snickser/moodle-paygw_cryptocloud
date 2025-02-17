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
 * Contains class for cryptocloud payment gateway.
 *
 * @package    paygw_cryptocloud
 * @copyright  2024 Alex Orlov <snickser@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace paygw_cryptocloud;

/**
 * The gateway class for cryptocloud payment gateway.
 *
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class gateway extends \core_payment\gateway {
    /**
     * Configuration form for currency
     */
    public static function get_supported_currencies(): array {
        // 3-character ISO-4217: https://en.wikipedia.org/wiki/ISO_4217#Active_codes.
        return [
            'USD', 'UZS', 'KGS', 'KZT', 'AMD', 'AZN', 'BYR', 'AUD', 'TRY', 'AED', 'CAD', 'CNY', 'HKD', 'IDR',
            'INR', 'JPY', 'PHP', 'SGD', 'THB', 'VND', 'MYR', 'RUB', 'UAH', 'EUR', 'GBP',
        ];
    }

    /**
     * Configuration form for the gateway instance
     *
     * Use $form->get_mform() to access the \MoodleQuickForm instance
     *
     * @param \core_payment\form\account_gateway $form
     */
    public static function add_configuration_to_gateway_form(\core_payment\form\account_gateway $form): void {
        $mform = $form->get_mform();

        $mform->addElement('text', 'shopid', get_string('shopid', 'paygw_cryptocloud'));
        $mform->setType('shopid', PARAM_TEXT);
        $mform->addRule('shopid', get_string('required'), 'required', null, 'client');

        $mform->addElement('text', 'apikey', get_string('apikey', 'paygw_cryptocloud'), ['size' => 30]);
        $mform->setType('apikey', PARAM_TEXT);
        $mform->addRule('apikey', get_string('required'), 'required', null, 'client');

        $mform->addElement('text', 'secretkey', get_string('secretkey', 'paygw_cryptocloud'), ['size' => 30]);
        $mform->setType('secretkey', PARAM_TEXT);
        $mform->addRule('secretkey', get_string('required'), 'required', null, 'client');

        $options = [
            'USDT_TRC20' => 'USDT_TRC20',
            'USDC_TRC20' => 'USDC_TRC20',
            'TUSD_TRC20' => 'TUSD_TRC20',
            'USDT_ERC20' => 'USDT_ERC20',
            'USDC_ERC20' => 'USDC_ERC20',
            'TUSD_ERC20' => 'TUSD_ERC20',
            'BTC' => 'BTC',
            'LTC' => 'LTC',
            'ETH' => 'ETH',
            ];
        $select = $mform->addElement(
            'select',
            'cryptocurrency',
            get_string('cryptocurrency', 'paygw_cryptocloud'),
            $options,
            ['size' => 9]
        );
        $select->setMultiple(true);
        $mform->setDefault('cryptocurrency', 'USDT_TRC20');

        $mform->addElement('static');

        $mform->addElement(
            'advcheckbox',
            'skipmode',
            get_string('skipmode', 'paygw_cryptocloud')
        );
        $mform->setType('skipmode', PARAM_INT);
        $mform->addHelpButton('skipmode', 'skipmode', 'paygw_cryptocloud');

        $mform->addElement(
            'advcheckbox',
            'passwordmode',
            get_string('passwordmode', 'paygw_cryptocloud')
        );
        $mform->setType('passwordmode', PARAM_INT);
        $mform->disabledIf('passwordmode', 'skipmode', "neq", 0);

        $mform->addElement('text', 'password', get_string('password', 'paygw_cryptocloud'), ['size' => 20]);
        $mform->setType('password', PARAM_TEXT);
        $mform->disabledIf('password', 'passwordmode');
        $mform->disabledIf('password', 'skipmode', "neq", 0);
        $mform->addHelpButton('password', 'password', 'paygw_cryptocloud');

        $mform->addElement(
            'advcheckbox',
            'usedetails',
            get_string('usedetails', 'paygw_cryptocloud')
        );
        $mform->setType('usedetails', PARAM_INT);
        $mform->addHelpButton('usedetails', 'usedetails', 'paygw_cryptocloud');

        $mform->addElement(
            'advcheckbox',
            'showduration',
            get_string('showduration', 'paygw_cryptocloud')
        );
        $mform->setType('showduration', PARAM_INT);

        $mform->addElement(
            'advcheckbox',
            'fixcost',
            get_string('fixcost', 'paygw_cryptocloud')
        );
        $mform->setType('fixcost', PARAM_INT);
        $mform->addHelpButton('fixcost', 'fixcost', 'paygw_cryptocloud');

        $mform->addElement('text', 'suggest', get_string('suggest', 'paygw_cryptocloud'), ['size' => 10]);
        $mform->setType('suggest', PARAM_TEXT);
        $mform->disabledIf('suggest', 'fixcost', "neq", 0);

        $mform->addElement('text', 'maxcost', get_string('maxcost', 'paygw_cryptocloud'), ['size' => 10]);
        $mform->setType('maxcost', PARAM_TEXT);
        $mform->disabledIf('maxcost', 'fixcost', "neq", 0);

        global $CFG;
        $mform->addElement('html', '<div class="label-callback" style="background: pink; padding: 15px;">' .
                                    get_string('callback_url', 'paygw_cryptocloud') . '<br>');
        $mform->addElement('html', $CFG->wwwroot . '/payment/gateway/cryptocloud/callback.php<br>');
        $mform->addElement('html', get_string('return_url', 'paygw_cryptocloud') . '<br>');
        $mform->addElement('html', $CFG->wwwroot . '/payment/gateway/cryptocloud/return.php<br>');
        $mform->addElement('html', get_string('callback_help', 'paygw_cryptocloud') . '</div><br>');

        $plugininfo = \core_plugin_manager::instance()->get_plugin_info('paygw_cryptocloud');
        $donate = get_string('donate', 'paygw_cryptocloud', $plugininfo);
        $mform->addElement('html', $donate);
    }

    /**
     * Validates the gateway configuration form.
     *
     * @param \core_payment\form\account_gateway $form
     * @param \stdClass $data
     * @param array $files
     * @param array $errors form errors (passed by reference)
     */
    public static function validate_gateway_form(
        \core_payment\form\account_gateway $form,
        \stdClass $data,
        array $files,
        array &$errors
    ): void {
        if ($data->enabled && empty($data->shopid)) {
            $errors['enabled'] = get_string('gatewaycannotbeenabled', 'payment');
        }
        if ($data->maxcost && $data->maxcost < $data->suggest) {
            $errors['maxcost'] = get_string('maxcosterror', 'paygw_cryptocloud');
        }
    }
}
