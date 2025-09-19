<?php
namespace Sample\Crud\Block\Adminhtml\Contact\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{
    /**
     * Give Form
     *
     * @return void
     */
    protected function _prepareForm()
    {
        $form = $this->_formFactory->create([
            'data' => [
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save'),
                'method' => 'post'
            ]
        ]);

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Contact Information')]);

        $fieldset->addField('name', 'text', [
            'name' => 'name',
            'label' => __('Name'),
            'title' => __('Name'),
            'required' => true
        ]);

        $fieldset->addField('email', 'text', [
            'name' => 'email',
            'label' => __('Email'),
            'title' => __('Email'),
            'required' => true
        ]);

        $fieldset->addField('message', 'textarea', [
            'name' => 'message',
            'label' => __('Message'),
            'title' => __('Message'),
            'required' => true
        ]);

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
