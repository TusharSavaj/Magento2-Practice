<?php

namespace Sample\Crud\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Encryption\EncryptorInterface;

class Data extends AbstractHelper
{
    /**
     * @var EncryptorInterface
     */
    protected $encryptor;
    /**
     * Data Constructor
     *
     * @param Context $context
     * @param EncryptorInterface $encryptor
     */
    public function __construct(
        Context $context,
        EncryptorInterface $encryptor
    ) {
        parent::__construct($context);
        $this->encryptor = $encryptor;
    }
    /**
     * Give Admin Enable True/False
     *
     * @param bool $scope
     * @return boolean
     */
    public function isEnabled($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'sample_contact/general/enabled',
            $scope
        );
    }
    /**
     * Give Title
     *
     * @param text $scope
     * @return void
     */
    public function getTitle($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->getValue(
            'sample_contact/general/title',
            $scope
        );
    }
    /**
     * Give Secret Key
     *
     * @param int $scope
     * @return void
     */
    public function getSecretKey($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        $secretKey = $this->scopeConfig->getValue(
            'sample_contact/general/secret_key',
            $scope
        );
        $secretKey = $this->encryptor->decrypt($secretKey);
        
        return $secretKey;
    }
    /**
     * Give Option
     *
     * @param int $scope
     * @return void
     */
    public function getOption($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->getValue(
            'sample_contact/general/option',
            $scope
        );
    }
}
