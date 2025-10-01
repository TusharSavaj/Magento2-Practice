<?php

namespace SparesZone\ContactUs\Model\ResourceModel\ContactUs;

use SparesZone\ContactUs\Model\ContactUs as ContactUsModel;
use SparesZone\ContactUs\Model\ResourceModel\ContactUs as ContactUsResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $idFieldName = "contact_id";

    /**
     * Initialize ProcessCollection
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _construct()
    {
        $this->_init(
            ContactUsModel::class,
            ContactUsResourceModel::class
        );
    }
}
