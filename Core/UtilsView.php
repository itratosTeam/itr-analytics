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

namespace Itratos\Oxid\ItrAnalytics\Core;

use OxidEsales\Eshop\Core\Registry;
use Itratos\Oxid\ItrAnalytics\Model\ItrAnalytics;

class UtilsView extends UtilsView_parent
{
    /**
     * Registers a new function "itr_analytics".
     *
     * @param bool $blReload
     * @return mixed
     */
    public function getSmarty($blReload = false)
    {
        $oSmarty = parent::getSmarty($blReload);
        // New function.
        $oSmarty->register_function('itr_analytics', [\Itratos\Oxid\ItrAnalytics\Core\UtilsView::class, 'itr_analytics'], false);

        return $oSmarty;
    }

    /**
     *
     * @param $params
     * @param $smarty
     * @return string
     */
    public static function itr_analytics($params, &$smarty)
    {
        $oConfig = Registry::getConfig();
        if ($oConfig->getConfigParam('itr_analytics_emos_active') == true
            || $oConfig->getConfigParam('itr_analytics_gtag_active' == true)) {
            /* @var ItrAnalytics */
            $oTracker = Registry::get(\Itratos\Oxid\ItrAnalytics\Model\ItrAnalytics::class);
            return $oTracker->getCode($params, $smarty);
        }
        return '';
    }
}