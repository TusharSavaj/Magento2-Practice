<?php

namespace SparesZone\ContactUs\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use SparesZone\ContactUs\Model\ContactUsFactory;

class Delete extends Action
{
    /**
     * @var ContactUsFactory
     */
    protected $contactusFactory;

    /**
     * Delete Constructor
     *
     * @param Context $context
     * @param ContactUsFactory $contactusFactory
     */
    public function __construct(
        Context $context,
        ContactUsFactory $contactusFactory
    ) {
        $this->contactusFactory = $contactusFactory;
        parent::__construct($context);
    }

    /**
     * Execute method for deleting a contact
     *
     * @return Redirect
     */
    public function execute()
    {
        $fieldid = $this->getRequest()->getParam('contact_id');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/');

        if ($fieldid) {
            try {
                $model = $this->contactusFactory->create();
                $model->load($fieldid);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Contact deleted successfully.'));
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('An error occurred while deleting the contact.'));
            }

            $resultRedirect->setPath('*/*/index', ['contact_id' => $fieldid]);
            return $resultRedirect;
        }

        $this->messageManager->addErrorMessage(__('Cannot find a contact to delete.'));
        return $resultRedirect;
    }
}
