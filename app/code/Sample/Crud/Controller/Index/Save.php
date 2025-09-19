<?php

namespace Sample\Crud\Controller\Index;

class Save extends \Magento\Framework\App\Action\Action
{
     /**
      * @var PageFactory
      */
     protected $_pageFactory;
     /**
      * @var ContactFactory
      */
     protected $_contactFactory;
     /**
      * Save Constructor
      *
      * @param \Magento\Framework\App\Action\Context $context
      * @param \Magento\Framework\View\Result\PageFactory $pageFactory
      * @param \Sample\Crud\Model\ContactFactory $contactFactory
      */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Sample\Crud\Model\ContactFactory $contactFactory
    ) {
         $this->_pageFactory = $pageFactory;
         $this->_contactFactory = $contactFactory;
         return parent::__construct($context);
    }
     /**
      * Execute Function
      *
      * @return void
      */
    public function execute()
    {
        if ($this->getRequest()->isPost()) {
             $input = $this->getRequest()->getPostValue();
             $postData = $this->_contactFactory->create();
            if (isset($input['editId'])) {
                $id = $input['editId'];
            } else {
                $id = 0;
            }
            if ($id != 0) {
                 $postData->load($id);
                 $postData->addData($input);
                 $postData->setId($id);
                 $postData->save();
            } else {
                 $postData->setData($input)->save();
            }
             $this->messageManager->addSuccessMessage("Data added successfully!");
             return $this->_redirect('crud/index/index');
        }
         return $this->_redirect('crud/index/index');
    }
}
