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

namespace Itratos\Oxid\ItrAnalytics\Component;


use Itratos\Oxid\ItrAnalytics\Model\EmosItem;

class ArticleDetails extends ArticleDetails_parent
{
    /**
     * Returns the main emos code.
     *
     * @param $aEmos
     * @return mixed
     */
    public function getEmosCode(&$aEmos)
    {
        $aEmos['content'] = $this->getProduct()->getEmosContent();
        $aEmos['ec_Event'] = [$this->getEmosEvent('view')];

        return $aEmos;
    }

    /**
     * Prepare and return the emos event.
     *
     * @return mixed
     */
    protected function getEmosEvent($sType = 'view')
    {
        return $this->getProduct()->getEmosItem()->toEmosArray($sType);
    }

    public function getGoogleTagEvents(&$aGoogleTagEvents)
    {
        $oCur = $this->getConfig()->getActShopCurrencyObject();
        $oProduct = $this->getProduct();

        $aGoogleTagEvents['view_item'] = [
            'items' => [['id' => $oProduct->getTrackingProductNumber(),
                'name' => $oProduct->getTrackingProductName(),
                'brand' => $oProduct->getVendor() ? $oProduct->getVendor()->getTitle() : "n.a.",
                'price' => $oProduct->getPrice()->getBruttoPrice() * (1 / $oCur->rate),
                'category' => $oProduct->getEmosContent()]]
        ];

        return $aGoogleTagEvents;
    }
}