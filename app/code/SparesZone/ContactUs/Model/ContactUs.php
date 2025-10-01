<?php

namespace SparesZone\ContactUs\Model;

use Magento\Framework\Model\AbstractModel;

class ContactUs extends AbstractModel
{
    /**
     * Inistialize resource model
     *
     * @return void
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\ContactUs::class);
    }
}
