<?php

namespace Sample\Crud\Block;

class Insert extends \Magento\Framework\View\Element\Template
{
     /**
      * @var PageFactory
      */
     protected $_pageFactory;
     /**
      * Insert Constructor
      *
      * @param \Magento\Framework\View\Element\Template\Context $context
      * @param \Magento\Framework\View\Result\PageFactory $pageFactory
      */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
         $this->_pageFactory = $pageFactory;
         return parent::__construct($context);
    }
     /**
      * Execute method for Insert a contact
      *
      * @return void
      */
    public function execute()
    {
         return $this->_pageFactory->create();
    }
}
