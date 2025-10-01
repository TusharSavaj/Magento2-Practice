<?php

namespace SparesZone\ContactUs\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ContactUs extends AbstractDb
{
    /**
     * Table Name
     */
    public const TABLE_NAME = 'spareszone_contact_us';

    /**
     * Primary ID
     */
    public const PRIMARY_ID = 'contact_id';

    /**
     * Initialize Process Resource Model
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::PRIMARY_ID);
    }
}
