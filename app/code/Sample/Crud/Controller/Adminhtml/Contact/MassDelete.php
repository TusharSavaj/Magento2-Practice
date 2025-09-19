<?php
namespace Sample\Crud\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Sample\Crud\Model\ResourceModel\Contact\CollectionFactory;

class MassDelete extends Action
{
    public const ADMIN_RESOURCE = 'Sample_Crud::contact';

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * massDelete Constructor
     *
     * @param Action\Context $context
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Action\Context $context,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
    }
    /**
     * Execute method for massDelete a contact
     *
     * @return void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('selected');
                $collection = $this->collectionFactory->create()->addFieldToFilter('id', ['in' => $id]);
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
