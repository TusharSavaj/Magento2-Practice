<?php

namespace Sample\Crud\Model;

use Magento\Framework\Model\AbstractModel;
use Sample\Crud\Model\ResourceModel\Contact as ContactResourceModel;

class Contact extends AbstractModel
{
    /**
     * Contact Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ContactResourceModel::class);
    }
}
