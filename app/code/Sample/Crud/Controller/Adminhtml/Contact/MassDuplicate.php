<?php
namespace Sample\Crud\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Sample\Crud\Model\ContactFactory;
use Magento\Framework\View\Result\PageFactory;
use Sample\Crud\Model\ResourceModel\Contact\CollectionFactory;

class MassDuplicate extends Action
{
    /**
     * @var ContactFactory
     */
    protected $contactFactory;
    /**
     * @var Filter
     */
    protected $filter;
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * massDuplicate Constructor
     *
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param PageFactory $resultPageFactory
     * @param ContactFactory $contactFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        PageFactory $resultPageFactory,
        ContactFactory $contactFactory
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->contactFactory = $contactFactory;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute method for massDuplicate a contact
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $error = false;
        foreach ($collection as $item) {
            $Id = $item->getId();
            // print_r($Id);
            $originalContact = $this->contactFactory->create()->load($Id);
            $newContact = $this->contactFactory->create();
            $newContact->addData($originalContact->getData());
            $newContact->setId(null);
            $newContact->setName($originalContact->getName());

            try {
                $newContact->save();
            } catch (\Exception $e) {
                $error = true;
            }
           
        }
        if ($error) {
            $this->messageManager->addErrorMessage(__('Error duplicating Contact: %1', $e->getMessage()));
            return $resultRedirect->setPath('crud/contact/');
        }
        $this->messageManager->addSuccessMessage(
            __('A total of %1 Contatct have been duplicated.', $collection->getSize())
        );

        return $resultRedirect->setPath('*/*/index');
    }
}
