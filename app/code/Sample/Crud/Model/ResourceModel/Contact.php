<?php

namespace Sample\Crud\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Contact extends AbstractDb
{
    /**
     * Contact Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('sample_crud_contact', 'id');
    }
}
