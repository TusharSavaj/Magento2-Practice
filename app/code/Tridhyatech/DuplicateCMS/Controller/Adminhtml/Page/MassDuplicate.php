<?php

/**
 * @author Tridhyatech Team
 * @copyright Copyright (c) 2024 Tridhyatech (https://www.tridhyatech.com)
 * @package Tridhyatech_DuplicateCMS
 */

declare(strict_types=1);

namespace Tridhyatech\DuplicateCMS\Controller\Adminhtml\Page;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Cms\Model\PageFactory;
use Magento\Cms\Model\ResourceModel\Page\CollectionFactory;
use Tridhyatech\DuplicateCMS\ViewModel\ConfigData;

class MassDuplicate extends \Magento\Backend\App\Action implements HttpPostActionInterface
{

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ConfigData
     */
    protected $configData;

    /**
     * Mass duplicate constrcutor
     *
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param ConfigData $configData
     * @param PageFactory $pageFactory
     * @param ResultFactory $resultFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        ConfigData $configData,
        PageFactory $pageFactory,
        ResultFactory $resultFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->configData = $configData;
        $this->pageFactory = $pageFactory;
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return void
     */
    public function execute()
    {
        if (!($this->configData->isEnabled())) {
            $this->messageManager->addErrorMessage(
                __('The module is currently not enabled to facilitate duplication.')
            );
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('cms/page/');
        }
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $error = false;
        foreach ($collection as $item) {
            $pageId = $item->getId();
            $originalPage = $this->pageFactory->create()->load($pageId);
            // Logic to duplicate the page
            $newPage = $this->pageFactory->create();
            $newPage->addData($originalPage->getData());
            $newPage->setId(null);
            $newPage->setIsActive(0);
            $newPage->setCreationTime(date('Y-m-d H:i:s'));
            $newPage->setIdentifier($originalPage->getIdentifier() . '-' . uniqid());
            try {
                $newPage->save();
            } catch (\Exception $e) {
                $error = true;
            }
        }
        if ($error) {
            $this->messageManager->addErrorMessage(__('Error duplicating page: %1', $e->getMessage()));
            return $resultRedirect->setPath('cms/page/');
        }
        $this->messageManager->addSuccessMessage(
            __('A total of %1 pages have been duplicated.', $collection->getSize())
        );

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('cms/page/');
    }
}
