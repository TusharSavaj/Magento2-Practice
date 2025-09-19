<?php

namespace Sample\Crud\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Sample\Crud\Model\ContactFactory;

class Delete extends Action
{
    /**
     * @var ContactFactory
     */
    protected $contactFactory;
    /**
     * Delete Constructor
     *
     * @param Context $context
     * @param ContactFactory $contactFactory
     */
    public function __construct(
        Context $context,
        ContactFactory $contactFactory
    ) {
        $this->contactFactory = $contactFactory;
        parent::__construct($context);
    }
    /**
     * Execute method for Delete a contact
     *
     * @return void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/');

        if ($id) {
            try {
                $model = $this->contactFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Contact deleted successfully.'));
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('An error occurred while deleting the contact.'));
            }

            $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            return $resultRedirect;
        }

        $this->messageManager->addErrorMessage(__('Cannot find a contact to delete.'));
        return $resultRedirect;
    }
}
