<?php
namespace Sample\Crud\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Sample\Crud\Model\ContactFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\Redirect;

class Index extends Action
{
    public const ADMIN_RESOURCE = 'Sample_Crud::contact';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ContactFactory
     */
    protected $contactFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param ContactFactory $contactFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ContactFactory $contactFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->contactFactory = $contactFactory;
    }

    /**
     * Execute method for Index a contact
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            // Duplicate logic
            $resultRedirect = $this->resultRedirectFactory->create();
            try {
                $originalContact = $this->contactFactory->create()->load($id);

                if (!$originalContact->getId()) {
                    $this->messageManager->addError(__('Contact not found.'));
                    return $resultRedirect->setPath('*/*/index');
                }

                $newContact = $this->contactFactory->create();
                $newContact->addData($originalContact->getData());
                $newContact->setId(null); // Unset ID for new entry
                $newContact->setName($originalContact->getName()); // Optional, can modify name if needed
                $newContact->save();

                $this->messageManager->addSuccess(__('Contact duplicated successfully.'));
            } catch (\Exception $e) {
                $this->messageManager->addError(__('Something went wrong while duplicating the contact.'));
            }

            return $resultRedirect->setPath('*/*/index');
        }

        // Default: load grid page
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Sample_Crud::contact');
        $resultPage->addBreadcrumb(__('Contact Data'), __('Contact Data'));
        $resultPage->getConfig()->getTitle()->prepend(__('Contact Data'));

        return $resultPage;
    }
}
