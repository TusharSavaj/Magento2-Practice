<?php

namespace Sample\Crud\Controller\Index;

class Insert extends \Magento\Framework\App\Action\Action
{
     /**
      * @var PageFactory
      */
     protected $_pageFactory;
     /**
      * Insert Constructor
      *
      * @param \Magento\Framework\App\Action\Context $context
      * @param \Magento\Framework\View\Result\PageFactory $pageFactory
      */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
         $this->_pageFactory = $pageFactory;
         return parent::__construct($context);
    }
     /**
      * Execute Function
      *
      * @return void
      */
    public function execute()
    {
         return $this->_pageFactory->create();
    }
}
