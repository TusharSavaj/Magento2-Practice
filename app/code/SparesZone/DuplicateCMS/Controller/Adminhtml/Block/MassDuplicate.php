<?php
/**
 * Spares Zone
 *
 * @package     SparesZone_DuplicateCMS
 * @copyright   Copyright (c) Spares Zone (https://www.spareszone.in/)
 * @license     https://www.spareszone.in/LICENSE.txt
 */

declare(strict_types=1);

namespace SparesZone\DuplicateCMS\Controller\Adminhtml\Block;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Cms\Model\BlockFactory;
use Magento\Cms\Model\ResourceModel\Block\CollectionFactory;
use SparesZone\DuplicateCMS\ViewModel\ConfigData;

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
     * @var BlockFactory
     */
    protected $blockFactory;

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
     * @param BlockFactory $blockFactory
     * @param ResultFactory $resultFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        ConfigData $configData,
        BlockFactory $blockFactory,
        ResultFactory $resultFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->configData = $configData;
        $this->blockFactory = $blockFactory;
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
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('cms/block/');
        }
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $error = false;
        foreach ($collection as $item) {
            $blockId = $item->getId();
            $originalBlock = $this->blockFactory->create()->load($blockId);
            // Logic to duplicate the block
            $newBlock = $this->blockFactory->create();
            $newBlock->addData($originalBlock->getData());
            $newBlock->setId(null);
            $newBlock->setIsActive(0);
            $newBlock->setCreationTime(date('Y-m-d H:i:s'));
            $newBlock->setIdentifier($originalBlock->getIdentifier() . '-' . uniqid());
            try {
                $newBlock->save();
            } catch (\Exception $e) {
                $error = true;
            }
        }
        if ($error) {
            $this->messageManager->addErrorMessage(__('Error duplicating block: %1', $e->getMessage()));
            return $resultRedirect->setPath('cms/block/');
        }
        $this->messageManager->addSuccessMessage(
            __('A total of %1 blocks have been duplicated.', $collection->getSize())
        );

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('cms/block/');
    }
}
