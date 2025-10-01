<?php

namespace SparesZone\ContactUs\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config implements ArgumentInterface
{
    public const CONFIG_ISENABLE_CONTACTUS = 'contactus/general/active';
    /**
     * @var ScopeInterface
     */
    private $scopeConfig;
    /**
     * Config Constructor
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }
    /**
     * Is Enable/Disable Function
     *
     * @return boolean
     */
    public function isEnabled()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ISENABLE_CONTACTUS, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
}
