<?php
namespace Homepage\Slider\Block\Adminhtml\Post;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

class BreakPoint extends AbstractFieldArray
{
    
    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function prepareToRender()
    {
        $this->addColumn('break_point', ['label' => __('Break Point'), 'class' => 'required-entry']);
        $this->addColumn('no_of_products', ['label' => __('No of Products'), 'class' => 'required-entry']);
        $this->addColumn('space_between', ['label' => __('Space between Products'), 'class' => 'required-entry']);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * Prepare existing row data object
     *
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function prepareArrayRow(DataObject $row): void
    {
        $options = [];
        $row->setData('option_extra_attrs', $options);
    }
}
