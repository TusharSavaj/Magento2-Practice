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

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Cms\Model\BlockFactory;
use SparesZone\DuplicateCMS\ViewModel\ConfigData;

class Index extends Action
{
    /**
     * @var BlockFactory
     */
    protected $blockFactory;

    /**
     * @var ConfigData
     */
    protected $configData;

    /**
     * Constrcutor Duplicate
     *
     * @param Action\Context $context
     * @param BlockFactory $blockFactory
     * @param ConfigData $configData
     */
    public function __construct(
        Action\Context $context,
        BlockFactory $blockFactory,
        ConfigData $configData
    ) {
        parent::__construct($context);
        $this->blockFactory = $blockFactory;
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
        $blockId = $this->getRequest()->getParam('block_id');
        $originalBlock = $this->blockFactory->create()->load($blockId);
        // Logic to duplicate the block
        $newBlock = $this->blockFactory->create();
        $newBlock->addData($originalBlock->getData());
        $newBlock->setId(null);
        $newBlock->setIsActive(0);
        $newBlock->setCreationTime(date('Y-m-d H:i:s'));
        $newBlock->setIdentifier($originalBlock->getIdentifier() . '-' . uniqid());
        // Modify other attributes as needed

        try {
            $newBlock->save();
            $this->messageManager->addSuccessMessage(__('Block duplicate successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error duplicating block: %1', $e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath(
            'cms/block/edit',
            [
                'block_id' => $newBlock->getId(),
                '_current' => true,
            ]
        );
    }
}
