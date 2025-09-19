<?php
/**
 * Spares Zone
 *
 * @package     SparesZone_DuplicateCMS
 * @copyright   Copyright (c) Spares Zone (https://www.spareszone.in/)
 * @license     https://www.spareszone.in/LICENSE.txt
 */

declare(strict_types=1);

namespace SparesZone\DuplicateCMS\Block\Adminhtml\Block\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\BlockRepositoryInterface;
use SparesZone\DuplicateCMS\ViewModel\ConfigData;
use Magento\Cms\Block\Adminhtml\Block\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DuplicateButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var ConfigData
     */
    protected $configData;

    /**
     * Constructor method
     *
     * @param Context $context
     * @param BlockRepositoryInterface $blockRepository
     * @param ConfigData $configData
     */
    public function __construct(
        Context $context,
        BlockRepositoryInterface $blockRepository,
        ConfigData $configData
    ) {
        parent::__construct($context, $blockRepository);
        $this->configData = $configData;
    }

    /**
     * To display button
     *
     * @return void
     */
    public function getButtonData()
    {
        if (!$this->configData->isEnabled()) {
            return [];
        }
        $data = [];
        if ($this->getBlockId()) {
            $data = [
                'label' => __('Duplicate Block'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to duplicate this?'
                ) . '\', \'' . $this->getDuplicateUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * Url to send delete requests to.
     *
     * @return string
     */
    public function getDuplicateUrl()
    {
        return $this->getUrl('duplicatecms/block/index', ['block_id' => $this->getBlockId()]);
    }
}
