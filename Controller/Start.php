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

use OxidEsales\Eshop\Core\Registry;

class Start extends Start_parent
{
    public function getEmosCode(&$aEmos)
    {
        $oRequest = Registry::getRequest();

        if ($this->getFncName() === 'login_noredirect') {
            $oUser = $this->getUser();
            $aEmos['login'] = array(
                array(
                    md5($oRequest->getRequestParameter('lgn_usr')), ($oUser ? '0' : '1')
                )
            );
        }

        $this->setBasketInformation($aEmos);

        $aEmos['content'] = 'Start';

        return $aEmos;
    }

    protected function setBasketInformation(&$aEmos)
    {
        $oSession = Registry::getSession();
        if ($aBasketAddInfo = $oSession->getVariable('itr_addItemInfo')) {

            $aBasket = array();
            foreach ($aBasketAddInfo as $sItemId => $aItemData) {
                $oProduct = oxNew(\OxidEsales\Eshop\Application\Model\Article::class);
                if ($oProduct->load($sItemId)) {
                    $aBasket[] = $oProduct->getEmosItem($aItemData['am'])->toEmosArray('c_add');
                }
            }
            $aEmos['ec_Event'] = $aBasket;

            $oSession->deleteVariable('itr_addItemInfo');
        }
    }
}