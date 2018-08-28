<?php
/**
 * This file is part of Itratos Limited & Co. KG itr-analytics module.
 *
 * Itratos Limited & Co. KG itr-analytics module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Itratos Limited & Co. KG itr-analytics module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Itratos Limited & Co. KG itr-analytics module.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.itratos.de
 * @copyright (C) Itratos Limited & Co. KG 2018
 */
$sLangName = "Deutsch";
$aLang = array(
    'charset' => 'UTF-8',
    'SHOP_MODULE_GROUP_itr_analytics_general' => 'Allgemeine Tracking Einstellungen',

    'SHOP_MODULE_itr_analytics_general_opt' => 'Datenschutz-konformes Tracking aktivieren?',
    'HELP_SHOP_MODULE_itr_analytics_general_opt' => 'Nein: es wird immer getrackt.<br>Opt-In: es wird erst nach Einwilligung durch den User getrackt.<br>Opt-Out: es wird solange getrackt, bis der User widerspricht.',
    'SHOP_MODULE_itr_analytics_general_opt_0' => 'Nein',
    'SHOP_MODULE_itr_analytics_general_opt_1' => 'Opt-In',
    'SHOP_MODULE_itr_analytics_general_opt_2' => 'Opt-Out',

    'SHOP_MODULE_itr_analytics_general_artnum' => 'Artikelnummernfeld',
    'HELP_SHOP_MODULE_itr_analytics_general_artnum' => 'Lege hier fest welches Produktmerkmal als Produkt-ID verwendet werden soll.',
    'SHOP_MODULE_itr_analytics_general_artnum_0' => 'OXID',
    'SHOP_MODULE_itr_analytics_general_artnum_1' => 'OXARTNUM',

    'SHOP_MODULE_GROUP_itr_analytics_emos' => 'Econda - Emos Tracker',
    'SHOP_MODULE_itr_analytics_emos_active' => 'Aktiv?',
    'SHOP_MODULE_itr_analytics_emos_file' => 'Emos-Bibliothek Dateiname (z. B. emos3.js)',
    'SHOP_MODULE_itr_analytics_emos_extorder' => 'Erweiterte Bestellinformationen',
    'HELP_SHOP_MODULE_itr_analytics_emos_extorder' => 'Erweiterte Bestellinformationen tracken, siehe <a href="https://support.econda.de/pages/viewpage.action?pageId=4751506" target="_blank">Econda Dokumentation</a>',
    'SHOP_MODULE_itr_analytics_emos_extorderevent' => 'Event-Name der erweiterten Bestellinformationen',
    'HELP_SHOP_MODULE_itr_analytics_emos_extorderevent' => 'Gib hier den von Econda definierten Event-Namen ein, siehe <a href="https://support.econda.de/pages/viewpage.action?pageId=4751506" target="_blank">Econda Dokumentation</a>',

    'SHOP_MODULE_GROUP_itr_analytics_gtag' => 'Google - Analytics',
    'SHOP_MODULE_itr_analytics_gtag_active' => 'Aktiv?',
    'SHOP_MODULE_itr_analytics_gtag_analytics' => 'Analytics Account ID',
    'HELP_SHOP_MODULE_itr_analytics_gtag_analytics' => 'In der Form: UA-xxxxxxxx-x',
    'SHOP_MODULE_itr_analytics_gtag_anonymizeip' => 'IP anonymisieren',
    'HELP_SHOP_MODULE_itr_analytics_gtag_anonymizeip' => 'Wenn aktiv, dann wird die IP bei Google Analytics anonymisiert.',
    'SHOP_MODULE_itr_analytics_gtag_ecommerce' => 'Google Analytics Enhanced Ecommerce Tracking aktivieren',
    'HELP_SHOP_MODULE_itr_analytics_gtag_ecommerce' => '<a href="https://developers.google.com/tag-manager/enhanced-ecommerce" target="_blank">Google Enhanced Ecommerce</a>',
    'SHOP_MODULE_itr_analytics_gtag_adwords' => 'Google Adwords Account.',
    'HELP_SHOP_MODULE_itr_analytics_gtag_adwords' => 'Durch das Eintragen eines Adwords-Kontos (in der Form: AW-xxxxxxx/xxxxxxxxx) werden auch Konversionen an das Adwords-Konto übermittelt. ',
);