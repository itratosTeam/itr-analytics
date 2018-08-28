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

// Metadata version.
$sMetadataVersion = '2.0';


$aModule = array(
    'id' => 'itr_analytics',
    'title' => 'Oxid Analytics by Itratos Limited & Co. KG',
    'description' => array(
        'de' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '/translations/de/description.html'),
        'en' => file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '/translations/en/description.html'),
    ),
    'thumbnail' => 'itratos.png',
    'version' => '1.0',
    'author' => 'Itratos Limited & Co. KG',
    'url' => 'http://www.itratos.de',
    'email' => 'support@itratos.de',
    'extend' => array(
        \OxidEsales\Eshop\Core\UtilsView::class => Itratos\Oxid\ItrAnalytics\Core\UtilsView::class,
        \OxidEsales\Eshop\Application\Component\Widget\ArticleDetails::class => Itratos\Oxid\ItrAnalytics\Component\ArticleDetails::class,
        \OxidEsales\Eshop\Application\Controller\SearchController::class => Itratos\Oxid\ItrAnalytics\Controller\Search::class,
        \OxidEsales\Eshop\Application\Controller\PaymentController::class => Itratos\Oxid\ItrAnalytics\Controller\Payment::class,
        \OxidEsales\Eshop\Application\Controller\UserController::class => Itratos\Oxid\ItrAnalytics\Controller\User::class,
        \OxidEsales\Eshop\Application\Controller\RegisterController::class => Itratos\Oxid\ItrAnalytics\Controller\Register::class,
        \OxidEsales\Eshop\Application\Controller\StartController::class => Itratos\Oxid\ItrAnalytics\Controller\Start::class,
        \OxidEsales\Eshop\Application\Controller\ArticleListController::class => Itratos\Oxid\ItrAnalytics\Controller\ArticleList::class,
        \OxidEsales\Eshop\Application\Controller\AccountController::class => Itratos\Oxid\ItrAnalytics\Controller\Account::class,
        \OxidEsales\Eshop\Application\Controller\ContentController::class => Itratos\Oxid\ItrAnalytics\Controller\Content::class,
        \OxidEsales\Eshop\Application\Controller\ManufacturerListController::class => Itratos\Oxid\ItrAnalytics\Controller\ManufacturerList::class,
        \OxidEsales\Eshop\Application\Controller\ContactController::class => Itratos\Oxid\ItrAnalytics\Controller\Contact::class,
        \OxidEsales\Eshop\Application\Controller\NewsletterController::class => Itratos\Oxid\ItrAnalytics\Controller\Newsletter::class,
        \OxidEsales\Eshop\Application\Controller\OrderController::class => Itratos\Oxid\ItrAnalytics\Controller\Order::class,
        \OxidEsales\Eshop\Application\Controller\ThankYouController::class => Itratos\Oxid\ItrAnalytics\Controller\ThankYou::class,
        \OxidEsales\Eshop\Application\Model\Article::class => Itratos\Oxid\ItrAnalytics\Model\Article::class,
        \OxidEsales\Eshop\Application\Component\BasketComponent::class => Itratos\Oxid\ItrAnalytics\Component\Basket::class,
        \OxidEsales\Eshop\Application\Controller\BasketController::class => Itratos\Oxid\ItrAnalytics\Controller\Basket::class,
        \OxidEsales\Eshop\Application\Controller\AccountNoticeListController::class => Itratos\Oxid\ItrAnalytics\Controller\AccountNoticeList::class,
        \OxidEsales\Eshop\Application\Controller\AccountWishlistController::class => Itratos\Oxid\ItrAnalytics\Controller\AccountWishlist::class,
        \OxidEsales\Eshop\Application\Controller\AccountOrderController::class => Itratos\Oxid\ItrAnalytics\Controller\AccountOrder::class,
        \OxidEsales\Eshop\Application\Controller\AccountUserController::class => Itratos\Oxid\ItrAnalytics\Controller\AccountUser::class,
        \OxidEsales\Eshop\Application\Controller\AccountNewsletterController::class => Itratos\Oxid\ItrAnalytics\Controller\AccountNewsletter::class,
        \OxidEsales\Eshop\Application\Controller\AccountPasswordController::class => Itratos\Oxid\ItrAnalytics\Controller\AccountPassword::class,
    ),
    'controllers' => array(),
    // Events.
    'events' => array(
        'onDeactivate' => \Itratos\Oxid\ItrAnalytics\Core\ModuleEvents::onDeactivate(),
    ),
    'templates' => array(),
    'blocks' => array(
        array(
            'template' => 'widget/product/details.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/account/forgotpwd.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/account/login.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/account/newsletter.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/account/noticelist.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/account/order.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/account/password.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/account/register_success.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/account/user.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/account/wishlist.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/checkout/basket.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/checkout/order.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/checkout/payment.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/checkout/thankyou.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/checkout/user.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/info/content.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/info/newsletter.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/list/list.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/search/search.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/shop/start.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/wishlist/wishlist.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
        array(
            'template' => 'page/account/dashboard.tpl',
            'block' => 'itr_analytics',
            'file' => 'views/block/itr_analytics.tpl',
        ),
    ),
    // Module settings.
    'settings' => array(
        array(
            'group' => 'itr_analytics_general',
            'name' => 'itr_analytics_general_opt',
            'type' => 'select',
            'value' => '0',
            'constrains' => '0|1|2'
        ),
        array(
            'group' => 'itr_analytics_general',
            'name' => 'itr_analytics_general_artnum',
            'type' => 'select',
            'value' => '0',
            'constrains' => '0|1'
        ),
        array(
            'group' => 'itr_analytics_emos',
            'name' => 'itr_analytics_emos_active',
            'type' => 'bool',
        ),
        array(
            'group' => 'itr_analytics_emos',
            'name' => 'itr_analytics_emos_file',
            'type' => 'str',
            'value' => 'emos3.js'
        ),
        array(
            'group' => 'itr_analytics_emos',
            'name' => 'itr_analytics_emos_extorder',
            'type' => 'bool',
        ),
        array(
            'group' => 'itr_analytics_emos',
            'name' => 'itr_analytics_emos_extorderevent',
            'type' => 'str',
            'value' => 'billext'
        ),
        array(
            'group' => 'itr_analytics_gtag',
            'name' => 'itr_analytics_gtag_active',
            'type' => 'bool',
        ),
        array(
            'group' => 'itr_analytics_gtag',
            'name' => 'itr_analytics_gtag_analytics',
            'type' => 'str',
        ),
        array(
            'group' => 'itr_analytics_gtag',
            'name' => 'itr_analytics_gtag_anonymizeip',
            'type' => 'bool',
        ),
        array(
            'group' => 'itr_analytics_gtag',
            'name' => 'itr_analytics_gtag_ecommerce',
            'type' => 'bool',
        ),
        array(
            'group' => 'itr_analytics_gtag',
            'name' => 'itr_analytics_gtag_adwords',
            'type' => 'str',
        ),
    ),
);