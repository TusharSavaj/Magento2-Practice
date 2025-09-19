<?php

namespace Sample\Crud\Controller\Index;

class Delete extends \Magento\Framework\App\Action\Action
{
     /**
      * @var PageFactory
      */
     protected $_pageFactory;
     /**
      * @var Http
      */
     protected $_request;
     /**
      * @var ContactFactory
      */
     protected $_contactFactory;
     /**
      * Delete Constructor
      *
      * @param \Magento\Framework\App\Action\Context $context
      * @param \Magento\Framework\View\Result\PageFactory $pageFactory
      * @param \Magento\Framework\App\Request\Http $request
      * @param \Sample\Crud\Model\ContactFactory $contactFactory
      */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\Request\Http $request,
        \Sample\Crud\Model\ContactFactory $contactFactory
    ) {
         $this->_pageFactory = $pageFactory;
         $this->_request = $request;
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
         $id = $this->_request->getParam('id');
         $postData = $this->_contactFactory->create();
         $result = $postData->setId($id);
         $result = $result->delete();
         return $this->_redirect('crud/index/index');
    }
}
