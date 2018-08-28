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

namespace Itratos\Oxid\ItrAnalytics\Model;

use OxidEsales\Eshop\Application\Model\Category;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\ViewConfig;
use OxidEsales\PayPalModule\Model\Article;

class ItrAnalytics
{
    /**
     * Emos array.
     * @var array
     */
    private $aEmos = array();

    /**
     * @var Config
     */
    private $oConfig;

    /**
     * @var ViewConfig
     */
    private $oViewConfig;

    /**
     * Given params using smarty tag.
     * @var
     */
    private $aParams;

    /**Current smarty object.
     * @var
     */
    private $oSmarty;

    /**
     * @var null
     */
    private $sEmosLib = null;

    /**
     * EcondaTracker constructor.
     */
    public function __construct()
    {
        $this->oConfig = Registry::getConfig();
        $this->oViewConfig = oxNew(\OxidEsales\Eshop\Core\ViewConfig::class);
    }

    /**
     * Returns full url to the current emos js lib.
     *
     * @return string
     * @throws \oxFileException
     */
    protected function getEmosFilePath()
    {
        if ($this->sEmosLib == null) {
            $sFile = 'emos3.js';
            if ($sTmpFile = $this->getConfig()->getConfigParam('itr_analytics_emos_file')) {
                $sFile = $sTmpFile;
            }
            $sFileToLoad = $this->oViewConfig->getModuleUrl('itr_analytics', 'out/js/' . $sFile);

            if (empty($sFileToLoad)) {
                Registry::getUtils()->writeToLog("Emos lib not found: " . $sFile, "itr-analytics.log");
            } else {
                $this->sEmosLib = $sFileToLoad;
            }
        }

        return $this->sEmosLib;
    }

    /**
     * Returns the current controller.
     *
     * @return \OxidEsales\Eshop\Application\Controller\FrontendController
     */
    protected function getCurrentController()
    {
        return $this->getConfig()->getActiveView();
    }

    /**
     * Return active user object otherwise false.
     *
     * @return User
     */
    protected function getActiveUser()
    {
        /* @var User */
        $oUser = oxNew(User::class);
        $oUser->loadActiveUser();

        return $oUser;
    }

    /**
     * Returns active shop id.
     *
     * @return int
     */
    protected function getSiteId()
    {
        return $this->getConfig()->getShopId();
    }

    /**
     * Get basic language id.
     *
     * @return string
     */
    protected function getLangId()
    {
        return Registry::getLang()->getBaseLanguage();
    }

    /**
     * Returns an unique page id.
     *
     * @return string
     */
    protected function getPageId()
    {
        $oRequest = Registry::getRequest();
        return md5($this->getSiteId()
            . $this->getCurrentController()->getClassKey()
            . $this->getCurrentController()->getTemplateName()
            . $oRequest->getRequestParameter('cnid')
            . $oRequest->getRequestParameter('anid')
            . $oRequest->getRequestParameter('option'));
    }

    /**
     * Returns the current template name.
     *
     * @return mixed
     */
    protected function getTemplateName()
    {
        $sTpl = $this->getCurrentController()->getTemplateName();
        $oRequest = Registry::getRequest();
        if ($sReqTpl = $oRequest->getRequestParameter('tpl')) {
            $sTpl = $sReqTpl;
        }

        return $sTpl;
    }

    /**
     * Returns the config.
     *
     * @return Config
     */
    protected function getConfig(){
        return $this->oConfig;
    }

    /**
     * Returns the tracking code for econda and google gtag.
     * @param $aParams
     * @param $oSmarty
     * @return string
     * @throws \oxFileException
     */
    public function getCode($aParams, &$oSmarty)
    {
        // Assign given vars.
        $this->oSmarty = $oSmarty;
        $this->aParams = $aParams;

        $iTrackingOption = $this->getConfig()->getConfigParam('itr_analytics_general_opt');
        $blDoTrack = true;
        if ($iTrackingOption) {
            $blDoTrack = false;
            if ($iTrackingOption == 0) {
                // No GDPR tracking settings. Track all users.
                $blDoTrack = true;
            } else if ($iTrackingOption == 1) {
                // Check for opt-in and track users with opt-in cookie only.
                $iTracking = Registry::getUtilsServer()->getOxCookie('itr_analytics_optin');
                if ($iTracking && $iTracking == 1) {
                    $blDoTrack = true;
                }
            } else if ($iTrackingOption == 2) {
                // Check for opt-out. Do not track when there is an opt-out cookie.
                $blDoTrack = true;
                $iTracking = Registry::getUtilsServer()->getOxCookie('itr_analytics_optout');
                if ($iTracking && $iTracking == 1) {
                    $blDoTrack = false;
                }
            }
        }

        $sScript = '';
        if ($blDoTrack) {
            $sScript = '<div style="display:none;">';

            // Econda emos3 tracking.
            if ($this->getConfig()->getConfigParam('itr_analytics_emos_active') && $this->getEmosFilePath()) {
                // Generate js script.
                $sScript .= '<script>window.emos3 = { stored : [], send : function(p){this.stored.push(p);} };</script>';
                $sScript .= '<script src="' . $this->getEmosFilePath() . '" async="async"></script>';
                // Main script.
                $sScript .= '<script>try{';
                $this->aEmos['pageid'] = $this->getPageId();
                $this->aEmos['siteid'] = $this->getSiteId();
                $this->aEmos['langid'] = $this->getLangId();
                // Dynamic code generation using the current controller.
                if (method_exists($this->getCurrentController(), 'getEmosCode')) {
                    $this->getCurrentController()->getEmosCode($this->aEmos);
                }
                $sScript .= "\n" . 'var emospro = ' . json_encode($this->aEmos, JSON_PRETTY_PRINT) . ';';
                $sScript .= "\n" . 'window.emos3.send(emospro);';
                $sScript .= '}catch(e){}</script>';
            }

            $sGaAccount = $this->getConfig()->getConfigParam('itr_analytics_gtag_analytics');
            // Google analytics tracking.
            if ($this->getConfig()->getConfigParam('itr_analytics_gtag_active') && !empty($sGaAccount)) {
                $aGoogleTagEvents = array();
                $sScript .= '<script src="https://www.googletagmanager.com/gtag/js?id=' . $sGaAccount . '"></script>';
                $sScript .= '<script>';
                $sScript .= 'window.dataLayer = window.dataLayer || [];';
                $sScript .= 'function gtag() {dataLayer.push(arguments);}';

                $aGtagOptions = array();
                // Prepare gtag options object.
                if ($this->getConfig()->getConfigParam('itr_analytics_gtag_anonymizeip')) {
                    $aGtagOptions['anonymize_ip'] = true;
                }

                // Dynamic code generation using the current controller.
                if (method_exists($this->getCurrentController(), 'getGtagOptions')) {
                    $this->getCurrentController()->getGtagOptions($aGtagOptions);
                }

                $sScript .= 'gtag(\'js\', new Date());';
                $sScript .= 'gtag(\'config\', \'' . $sGaAccount . '\', ' . json_encode($aGtagOptions) . ');';

                // Configure adwords account if one is given.
                $sAdwordAcoount = $this->getConfig()->getConfigParam('itr_analytics_gtag_adwords');
                if(!empty($sAdwordAcoount)){
                    $aAdwords = explode('/', $sAdwordAcoount);
                    if(count($aAdwords) > 0){
                        $sScript .= 'gtag(\'config\', \'' . $aAdwords[0] . '\', ' . json_encode($aGtagOptions) . ');';
                    }
                }

                // Get additional tag events from current controller.
                if (method_exists($this->getCurrentController(), 'getGoogleTagEvents')) {
                    $this->getCurrentController()->getGoogleTagEvents($aGoogleTagEvents);
                }

                if(count($aGoogleTagEvents) > 0){
                    foreach ($aGoogleTagEvents as $key => $value){
                        $sScript .= 'gtag(\'event\', \''.$key.'\', '.json_encode($value).');';
                    }
                }

                $sScript .= '</script>';
            }

            $sScript .= '</div>';
        }

        return $sScript;
    }
}