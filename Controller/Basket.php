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

namespace Itratos\Oxid\ItrAnalytics\Controller;

use \OxidEsales\Eshop\Core\Registry;
use \OxidEsales\Eshop\Core\Session;

class Basket extends Basket_parent
{
    public function getEmosCode(&$aEmos)
    {
        $this->setBasketInformation($aEmos);

        $aEmos['content'] = 'Shopping/Checkout/Basket';
        $aEmos['orderProcess'] = '1_Basket';

        return $aEmos;
    }

    protected function setBasketInformation(&$aEmos)
    {
        $oSession = Registry::getSession();
        if ($aBasketAddInfo = $oSession->getVariable('itr_addItemInfo')) {

            $aBasket = array();
            debug($aBasketAddInfo);
            foreach ($aBasketAddInfo as $sItemId => $aItemData) {
                $oProduct = oxNew(\OxidEsales\Eshop\Application\Model\Article::class);
                if($aItemData['am'] > $aItemData['oldam']){
                    if ($oProduct->load($aItemData['aid'])) {
                        $aBasket[] = $oProduct->getEmosItem($aItemData['am'] - $aItemData['oldam'])->toEmosArray('c_add');
                    }
                }else if($aItemData['am'] < $aItemData['oldam']){
                    if ($oProduct->load($aItemData['aid'])) {
                        $aBasket[] = $oProduct->getEmosItem($aItemData['oldam'] - $aItemData['am'])->toEmosArray('c_rmv');
                    }
                }
            }
            $aEmos['ec_Event'] = $aBasket;

            $oSession->deleteVariable('itr_addItemInfo');
        }
    }
}