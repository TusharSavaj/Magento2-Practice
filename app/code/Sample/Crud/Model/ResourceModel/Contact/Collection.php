<?php

namespace Sample\Crud\Model\ResourceModel\Contact;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Sample\Crud\Model\Contact as ContactModel;
use Sample\Crud\Model\ResourceModel\Contact as ContactResourceModel;

class Collection extends AbstractCollection
{
    /**
     * Collection Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ContactModel::class, ContactResourceModel::class);
    }
}
