<?php
namespace Sample\Crud\Block\Adminhtml\Contact;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    /**
     * Edit Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'Sample_Crud';
        $this->_controller = 'adminhtml_contact';
        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Contact'));
        $this->buttonList->update('delete', 'label', __('Delete Contact'));
    }
    /**
     * Give Layout
     *
     * @return void
     */
    protected function _prepareLayout()
    {
        $this->addChild('form', \Sample\Crud\Block\Adminhtml\Contact\Edit\Form::class);
        return parent::_prepareLayout();
    }
}
