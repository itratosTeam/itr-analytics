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
use \OxidEsales\Eshop\Core\Request;

class Search extends Search_parent
{
    public function getEmosCode(&$aEmos)
    {
        $aEmos['content'] = 'Shopping/Search';

        $aSearch = array();
        $oRequest = Registry::getRequest();
        $iPage = $oRequest->getRequestParameter('pgNr');
        if (!$iPage) {
            $sSearchParamForLink = $oRequest->getRequestParameter('searchparam', true);
            $iSearchCount = $this->getArticleCount();
            $aSearch[] = array($sSearchParamForLink, $iSearchCount);
        }

        $aEmos['search'] = $aSearch;

        return $aEmos;
    }

    public function getGtagOptions(&$aOptions)
    {
        $oRequest = Registry::getRequest();
        $aOptions['page_path'] = 'Shopping/Search/' . $oRequest->getRequestParameter('searchparam', true);
        return $aOptions;
    }
}