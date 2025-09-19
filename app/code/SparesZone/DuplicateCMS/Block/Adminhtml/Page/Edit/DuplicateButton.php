<?php
/**
 * Spares Zone
 *
 * @package     SparesZone_DuplicateCMS
 * @copyright   Copyright (c) Spares Zone (https://www.spareszone.in/)
 * @license     https://www.spareszone.in/LICENSE.txt
 */

declare(strict_types=1);

namespace SparesZone\DuplicateCMS\Block\Adminhtml\Page\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\PageRepositoryInterface;
use SparesZone\DuplicateCMS\ViewModel\ConfigData;
use Magento\Cms\Block\Adminhtml\Page\Edit\GenericButton;
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
     * @param PageRepositoryInterface $pageRepository
     * @param ConfigData $configData
     */
    public function __construct(
        Context $context,
        PageRepositoryInterface $pageRepository,
        ConfigData $configData
    ) {
        parent::__construct($context, $pageRepository);
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
        if ($this->getPageId()) {
            $data = [
                'label' => __('Duplicate Page'),
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
        return $this->getUrl('duplicatecms/page/index', ['page_id' => $this->getPageId()]);
    }
}
