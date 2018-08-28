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

use \OxidEsales\Eshop\Core\Request;
use \OxidEsales\Eshop\Core\Registry;

class Account extends Account_parent
{
    /**
     * If google or econda tracking is active,
     * do not use oxusername in title tag.
     * see: GDPR law.
     *
     * @return string
     */
    public function getTitle()
    {
        if (($this->getConfig()->getConfigParam('itr_analytics_emos_active') || $this->getConfig()->getConfigParam('itr_analytics_gtag_active'))
            && $this->getConfig()->getActiveView()->getClassName() == 'account') {
            $baseLanguageId = \OxidEsales\Eshop\Core\Registry::getLang()->getBaseLanguage();
            return \OxidEsales\Eshop\Core\Registry::getLang()->translateString('PAGE_TITLE_ACCOUNT', $baseLanguageId, false);
        }

        return parent::getTitle();
    }

    public function getEmosCode(&$aEmos)
    {
        $oRequest = Registry::getRequest();

        if ($this->getUser()) {
            $aEmos['content'] = 'Account/Overview';
        } else {
            $aEmos['content'] = ($this->getFncName() === 'logout' ? 'Account/Form/SignOut' : 'Account/Form/SignIn');
        }

        if ($this->getFncName() === 'login_noredirect') {
            $oUser = $this->getUser();
            $aEmos['login'] = array(
                array(
                    md5($oRequest->getRequestParameter('lgn_usr')), ($oUser ? '0' : '1')
                )
            );
        }

        return $aEmos;
    }
}