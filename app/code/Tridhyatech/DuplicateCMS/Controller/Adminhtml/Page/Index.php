<?php

/**
 * @author Tridhyatech Team
 * @copyright Copyright (c) 2024 Tridhyatech (https://www.tridhyatech.com)
 * @package Tridhyatech_DuplicateCMS
 */

declare(strict_types=1);

namespace Tridhyatech\DuplicateCMS\Controller\Adminhtml\Page;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Cms\Model\PageFactory;
use Tridhyatech\DuplicateCMS\ViewModel\ConfigData;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * @var ConfigData
     */
    protected $configData;

    /**
     * Constrcutor Duplicate
     *
     * @param Action\Context $context
     * @param PageFactory $pageFactory
     * @param ConfigData $configData
     */
    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        ConfigData $configData
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->configData  = $configData;
    }

    /**
     * Execute method
     *
     * @return void
     */
    public function execute()
    {
        if (!($this->configData->isEnabled())) {
            $this->messageManager->addErrorMessage(
                __('The module is currently not enabled to facilitate duplication.')
            );
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
        }
        $pageId = $this->getRequest()->getParam('page_id');
        $originalPage = $this->pageFactory->create()->load($pageId);
        // Logic to duplicate the page
        $newPage = $this->pageFactory->create();
        $newPage->addData($originalPage->getData());
        $newPage->setId(null);
        $newPage->setIsActive(0);
        $newPage->setCreationTime(date('Y-m-d H:i:s'));
        $newPage->setIdentifier($originalPage->getIdentifier() . '-' . uniqid());
        // Modify other attributes as needed

        try {
            $newPage->save();
            $this->messageManager->addSuccessMessage(__('Page duplicate successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error duplicating page: %1', $e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath(
            'cms/page/edit',
            [
                'page_id' => $newPage->getId(),
                '_current' => true,
            ]
        );
    }
}
