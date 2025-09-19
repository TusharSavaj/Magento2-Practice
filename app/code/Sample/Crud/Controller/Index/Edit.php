<?php

namespace Sample\Crud\Controller\Index;

class Edit extends \Magento\Framework\App\Action\Action
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
      * @var Registry
      */
     protected $_coreRegistry;
     /**
      * Edit Constructor
      *
      * @param \Magento\Framework\App\Action\Context $context
      * @param \Magento\Framework\View\Result\PageFactory $pageFactory
      * @param \Magento\Framework\App\Request\Http $request
      * @param \Magento\Framework\Registry $coreRegistry
      */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Registry $coreRegistry
    ) {
         $this->_pageFactory = $pageFactory;
         $this->_request = $request;
         $this->_coreRegistry = $coreRegistry;
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
        $this->_coreRegistry->register('editId', $id);
         return $this->_pageFactory->create();
    }
}
