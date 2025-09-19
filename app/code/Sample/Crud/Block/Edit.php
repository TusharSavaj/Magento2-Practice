<?php

namespace Sample\Crud\Block;

class Edit extends \Magento\Framework\View\Element\Template
{
     /**
      * @var PageFactory
      */
     protected $_pageFactory;
     /**
      * @var Registry
      */
     protected $_coreRegistry;
     /**
      * @var ContactFactory
      */
     protected $_contactLoader;
     /**
      * Edit Constructor
      *
      * @param \Magento\Framework\View\Element\Template\Context $context
      * @param \Magento\Framework\View\Result\PageFactory $pageFactory
      * @param \Magento\Framework\Registry $coreRegistry
      * @param \Sample\Crud\Model\ContactFactory $contactLoader
      * @param array $data
      */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Sample\Crud\Model\ContactFactory $contactLoader,
        array $data = []
    ) {
         $this->_pageFactory = $pageFactory;
         $this->_coreRegistry = $coreRegistry;
         $this->_contactLoader = $contactLoader;
         return parent::__construct($context, $data);
    }
     /**
      * Execute method for Edit a contact
      *
      * @return void
      */
    public function execute()
    {
         return $this->_pageFactory->create();
    }
     /**
      * Give Contact EditData
      *
      * @return void
      */
    public function getEditData()
    {
         $id = $this->_coreRegistry->registry('editId');
         $postData = $this->_contactLoader->create();
         $result = $postData->load($id);
         $result = $result->getData();
         return $result;
    }
}
