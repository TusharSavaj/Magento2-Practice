<?php
/**
 * Spares Zone
 *
 * @package     SparesZone_DuplicateCMS
 * @copyright   Copyright (c) Spares Zone (https://www.spareszone.in/)
 * @license     https://www.spareszone.in/LICENSE.txt
 */

declare(strict_types=1);

namespace SparesZone\DuplicateCMS\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ConfigData implements ArgumentInterface
{
    public const DUPLICATE_ENABLED = 'duplicatecms/general/active';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * ConfigData constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Check if the extension is enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::DUPLICATE_ENABLED);
    }
}
