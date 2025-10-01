<?php
namespace SparesZone\ContactUs\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use SparesZone\ContactUs\Model\ResourceModel\ContactUs\CollectionFactory;
use SparesZone\ContactUs\Model\ContactUsFactory;

class MassDelete extends Action
{

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var ContactUsFactory
     */
    protected $contactUsFactory;
    /**
     * massDelete Constructor
     *
     * @param Action\Context $context
     * @param CollectionFactory $collectionFactory
     * @param ContactUsFactory $contactUsFactory
     */
    public function __construct(
        Action\Context $context,
        CollectionFactory $collectionFactory,
        ContactUsFactory $contactUsFactory
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
        $this->contactUsFactory = $contactUsFactory;
    }
    /**
     * Execute method for massDelete a contact
     *
     * @return void
     */
    public function execute()
    {
        $fieldid = $this->getRequest()->getParam('selected');
                $collection = $this->collectionFactory->create()->addFieldToFilter('contact_id', ['in' => $fieldid]);
                $count = 0;
        foreach ($collection as $item) {
            $item->delete();
            $count++;
        }

        $this->messageManager->addSuccessMessage(__('%1 contact(s) have been deleted.', $count));
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        
        return $resultRedirect->setPath('*/*/index');
    }
}
