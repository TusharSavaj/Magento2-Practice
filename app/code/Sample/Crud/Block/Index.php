<?php

namespace Sample\Crud\Block;

use Magento\Framework\View\Element\Template;
use Sample\Crud\Model\ContactFactory;

class Index extends Template
{
    /**
     * @var ContactFactory
     */
    protected $_contactFactory;
    /**
     * Index Constructor
     *
     * @param Template\Context $context
     * @param ContactFactory $contactFactory
     */
    public function __construct(
        Template\Context $context,
        ContactFactory $contactFactory
    ) {
        parent::__construct($context);
        $this->_contactFactory = $contactFactory;
    }
    /**
     * Give UserData
     *
     * @return void
     */
    public function getUserData()
    {
        $contact = $this->_contactFactory->create();
        $collection = $contact->getCollection();
        return $collection;
    }
}
