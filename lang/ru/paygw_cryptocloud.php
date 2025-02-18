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
 * Local language pack from https://study.bhuri.ru
 *
 * @package    paygw_cryptocloud
 * @subpackage cryptocloud
 * @copyright  2024 Alex Orlov <snickser@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['abouttopay'] = 'Вы собираетесь пожертвовать на';
$string['apikey'] = 'API Key';
$string['callback_help'] = 'Скопируйте эти строки и вставьте в настройках проекта в CryptoCloud. Отключите настройку "Мой проект на CMS".';
$string['callback_url'] = 'URL для уведомлений:';
$string['cost'] = 'Стоимость записи';
$string['cryptocurrency'] = 'Разрешенные валюты';
$string['currency'] = 'Валюта';
$string['fixcost'] = 'Режим фиксированной цены';
$string['fixcost_help'] = 'Отключает для студентов возможность оплаты произвольной суммой.';
$string['fixdesc'] = 'Фиксированный комментарий платежа';
$string['fixdesc_help'] = 'Эта настройка устанавливает фиксированный комментарий для всех платежей, и отключает отображение описания комментария на странице платежа.';
$string['gatewaydescription'] = 'CryptoCloud — надежный способ легко и удобно принимать оплату со всего мира в самых популярных криптовалютах.';
$string['istestmode'] = 'Тестовый режим';
$string['maxcost'] = 'Максимальная цена';
$string['maxcosterror'] = 'Максимальная цена должна быть выше рекомендуемой цены';
$string['message_invoice_created'] = 'Здравствуйте, {$a->firstname}!
Платёжная ссылка {$a->orderid} на {$a->localizedcost} успешно создана.
Вы можете совершить платёж по ней в течении часа.';
$string['password'] = 'Резервный пароль';
$string['password_error'] = 'Введён неверный платёжный пароль';
$string['password_help'] = 'С помощью этого пароля можно обойти процесс отплаты. Может быть полезен когда нет возможности произвести оплату.';
$string['password_success'] = 'Платёжный пароль принят';
$string['password_text'] = 'Если у вас нет возможности сделать пожертвование, то попросите у вашего куратора пароль и введите его.';
$string['passwordmode'] = 'Разрешить ввод резервного пароля';
$string['payment'] = 'Пожертвование';
$string['payment_error'] = 'Ошибка оплаты';
$string['payment_success'] = 'Оплата успешно произведена';
$string['paymentserver'] = 'URL сервера оплаты';
$string['paymore'] = 'Если вы хотите пожертвовать больше, то просто впишите свою сумму вместо указанной.';
$string['pluginname'] = 'Платежи CryptoCloud';
$string['pluginname_desc'] = 'Плагин cryptocloud позволяет получать платежи через CryptoCloud.';
$string['return_url'] = 'SuccessURL и FailURL:';
$string['secretkey'] = 'Secret key';
$string['sendpaymentbutton'] = 'Пожертвовать!';
$string['shopid'] = 'Идентификатор проекта';
$string['showduration'] = 'Показывать длительность обучения на странице';
$string['skipmode'] = 'Показать кнопку обхода платежа';
$string['skipmode_help'] = 'Эта настройка разрешает кнопку обхода платежа, может быть полезна в публичных курсах с необязательной оплатой.';
$string['skipmode_text'] = 'Если вы не имеете возможности совершить пожертвование через платёжную систему то можете нажать на эту кнопку.';
$string['skippaymentbutton'] = 'Не имею :(';
$string['suggest'] = 'Рекомендуемая цена';
$string['usedetails'] = 'Показывать свёрнутым';
$string['usedetails_help'] = 'Прячет кнопку или пароль под сворачиваемый блок, если они включены.';
$string['usedetails_text'] = 'Нажмите тут если у вас нет возможности совершить пожертвование';
$string['donate'] = '<div>Версия плагина: {$a->release} ({$a->versiondisk})<br>
Новые версии плагина вы можете найти на <a href=https://github.com/Snickser/moodle-paygw_cryptocloud>GitHub.com</a>
<img src="https://img.shields.io/github/v/release/Snickser/moodle-paygw_cryptocloud.svg"><br>
Пожалуйста, отправьте мне немножко <a href="https://yoomoney.ru/fundraise/143H2JO3LLE.240720">доната</a>😊</div>
TRX TYEUMcRVMkaKwAGKENMvvN1YvtNvrkw5kh<br>
BTC bc1q9gfmeh33497daetpugp9tjl56mggg966sgqhl0<br>
EVM 0x4E2E41CD0F72095126f3d2945C545D069629b4d4<br>
<iframe src="https://yoomoney.ru/quickpay/fundraise/button?billNumber=143H2JO3LLE.240720"
width="330" height="50" frameborder="0" allowtransparency="true" scrolling="no"></iframe>';
