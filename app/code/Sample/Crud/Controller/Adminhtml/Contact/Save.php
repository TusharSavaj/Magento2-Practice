<?php
namespace Sample\Crud\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action;
use \Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Backend\App\Action
{   
    protected $model;
    /**
     * Save Constructor
     *
     * @param Action\Context $context
     * @param \Sample\Crud\Model\ContactFactory $contactFactory
     */
    public function __construct(
        Action\Context $context,
        \Sample\Crud\Model\ContactFactory $contactFactory
    ) {
        parent::__construct($context);
        $this->model = $contactFactory;
    }
    /**
     * Execute method for Save a contact
     *
     * @return void
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('id');

            $postData = $this->model->create();

            if ($id) {
                $postData->load($id);
            }
        
            $postData->setData($data);

            try {
                $postData->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
