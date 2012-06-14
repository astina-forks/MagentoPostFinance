<?php
/**
 * Config model
 */
class PostFinance_Payment_Model_Config extends Mage_Payment_Model_Config
{
    const POSTFINANCE_PAYMENT_PATH = 'payment_services/postfinance/';
    const POSTFINANCE_CONTROLLER_ROUTE_API     = 'postfinance/api/';
    const POSTFINANCE_CONTROLLER_ROUTE_PAYMENT = 'postfinance/payment/';

    /**
     * Return PostFinance payment config information
     *
     * @param string $path
     * @param int $storeId
     * @return mixed
     */
    public function getConfigData($path, $storeId=null)
    {
        if (!empty($path)) {
            return Mage::getStoreConfig(self::POSTFINANCE_PAYMENT_PATH . $path, $storeId);
        }
        return false;
    }

    /**
     * Return SHA1-in crypt key from config. Setup on admin place.
     *
     * @param int $storeId
     * @return string
     */
    public function getShaInCode($storeId=null)
    {
        return Mage::helper('core')->decrypt($this->getConfigData('secret_key_in', $storeId));
    }

    /**
     * Return SHA1-out crypt key from config. Setup on admin place.
     * @param int $storeId
     * @return string
     */
    public function getShaOutCode($storeId=null)
    {
        return Mage::helper('core')->decrypt($this->getConfigData('secret_key_out', $storeId));
    }

    /**
     * Return frontend gateway path, get from config. Setup on admin place.
     *
     * @param int $storeId
     * @return string
     */
    public function getFrontendGatewayPath($storeId=null)
    {
        return $this->getConfigData('frontend_gateway', $storeId);
    }
    
    /**
     * Return Direct Link Gateway path, get from config. Setup on admin place.
     *
     * @param int $storeId
     * @return string
     */
    public function getDirectLinkGatewayPath($storeId=null)
    {
        return $this->getConfigData('directlink_gateway', $storeId);
    }
    
    public function getDirectLinkGatewayOrderPath($storeId=null)
    {
        return $this->getConfigData('directlink_gateway_order', $storeId);
    }

    /**
     * Return API User, get from config. Setup on admin place.
     *
     * @param int $storeId
     * @return string
     */
    public function getApiUserId($storeId=null)
    {
        return $this->getConfigData('api_userid', $storeId);
    }
    
    /**
     * Return API Passwd, get from config. Setup on admin place.
     *
     * @param int $storeId
     * @return string
     */
    public function getApiPswd($storeId=null)
    {
        return Mage::helper('core')->decrypt($this->getConfigData('api_pswd', $storeId));
    }
    
    /**
     * Get PSPID, affiliation name in PostFinanc system
     *
     * @param int $storeId
     * @return string
     */
    public function getPSPID($storeId=null)
    {
        return $this->getConfigData('pspid', $storeId);
    }

    public function getPaymentAction($storeId=null)
    {
        return $this->getConfigData('payment_action', $storeId);
    }

    /**
     * Get paypage template for Magento style templates using
     *
     * @return string
     */
    public function getPayPageTemplate()
    {
        return Mage::getUrl(self::POSTFINANCE_CONTROLLER_ROUTE_PAYMENT . 'paypage',
            array('_nosid' => true, '_secure' => $this->isCurrentlySecure()));
    }

    /**
     * Return url which PostFinance system will use as accept
     *
     * @return string
     */
    public function getAcceptUrl()
    {
        return Mage::getUrl(self::POSTFINANCE_CONTROLLER_ROUTE_PAYMENT . 'accept',
            array('_nosid' => true, '_secure' => $this->isCurrentlySecure()));
    }

    /**
     * Return url which PostFinance system will use as decline url
     *
     * @return string
     */
    public function getDeclineUrl()
    {
        return Mage::getUrl(self::POSTFINANCE_CONTROLLER_ROUTE_PAYMENT . 'decline',
            array('_nosid' => true, '_secure' => $this->isCurrentlySecure()));
    }

    /**
     * Return url which PostFinance system will use as exception url
     *
     * @return string
     */
    public function getExceptionUrl()
    {
        return Mage::getUrl(self::POSTFINANCE_CONTROLLER_ROUTE_PAYMENT . 'exception',
            array('_nosid' => true, '_secure' => $this->isCurrentlySecure()));
    }

    /**
     * Return url which PostFinance system will use as cancel url
     *
     * @return string
     */
    public function getCancelUrl()
    {
        return Mage::getUrl(self::POSTFINANCE_CONTROLLER_ROUTE_PAYMENT . 'cancel',
            array('_nosid' => true, '_secure' => $this->isCurrentlySecure()));
    }

    /**
     * Return url which PostFinance system will use as continue shopping url
     *
     * @param array $redirect
     *
     * @return string
     */
    public function getContinueUrl($redirect = array())
    {
        $urlParams = array('_nosid' => true, '_secure' => $this->isCurrentlySecure());
        if (!empty($redirect)) $urlParams = array_merge($redirect, $urlParams);
        return Mage::getUrl(self::POSTFINANCE_CONTROLLER_ROUTE_PAYMENT . 'continue', $urlParams);
    }

    /**
     * Return url to redirect after confirming the order
     * 
     * @return string
     */
    public function getPaymentRedirectUrl()
    {
        return Mage::getUrl(self::POSTFINANCE_CONTROLLER_ROUTE_PAYMENT . 'placeform',
            array('_secure' => true, '_nosid' => true));
    }
    
    /**
     * Return 3D Secure url to redirect after confirming the order
     * 
     * @return string
     */
    public function get3dSecureRedirectUrl()
    {
        return Mage::getUrl(self::POSTFINANCE_CONTROLLER_ROUTE_PAYMENT . 'placeform3dsecure',
            array('_secure' => true, '_nosid' => true));
    }
    
    public function getSaveCcBrandUrl()
    {
        return Mage::getUrl(self::POSTFINANCE_CONTROLLER_ROUTE_PAYMENT . 'saveCcBrand',
            array('_secure' => $this->isCurrentlySecure(), '_nosid' => true));
    }

    public function getGenerateHashUrl()
    {
        return Mage::getUrl(self::POSTFINANCE_CONTROLLER_ROUTE_PAYMENT . 'generatehash',
            array('_secure' => $this->isCurrentlySecure(), '_nosid' => true));
    }

    public function getRegisterDirectDebitPaymentUrl()
    {
        return Mage::getUrl(self::POSTFINANCE_CONTROLLER_ROUTE_PAYMENT . 'registerDirectDebitPayment',
            array('_secure' => $this->isCurrentlySecure(), '_nosid' => true));
    }

    /**
     * Checks if requests should be logged or not regarding configuration
     */
    public function shouldLogRequests($storeId=null)
    {
        return $this->getConfigData('debug_flag', $storeId);
    }

    public function hasCatalogUrl()
    {
        return Mage::getStoreConfig('payment_services/postfinance/showcatalogbutton');
    }

    public function hasHomeUrl()
    {
        return Mage::getStoreConfig('payment_services/postfinance/showhomebutton');
    }

    public function getAcceptedCcTypes()
    {
        return Mage::getStoreConfig('payment/postfinance_cc/types');
    }
    
    public function get3dSecureIsActive()
    {
        return Mage::getStoreConfig('payment/postfinance_cc/enabled_3dsecure');
    }

    public function getAliasGatewayUrl($storeId = null)
    {
        return $this->getConfigData('postfinance_alias_gateway', $storeId);
    }

    public function getCcSaveAliasUrl()
    {
        return Mage::getUrl('postfinance/payment/saveAlias', array('_secure' => $this->isCurrentlySecure()));
    }

    public function isCurrentlySecure()
    {
        return Mage::app()->getStore()->isCurrentlySecure();
    }
}
