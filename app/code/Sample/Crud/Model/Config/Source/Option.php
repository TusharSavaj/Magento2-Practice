<?php

namespace Sample\Crud\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Option implements ArrayInterface
{
    /**
     * Give Option Array
     *
     * @return void
     */
    public function toOptionArray()
    {
        return [
            ['value' => '0', 'label' => __('Red')],
            ['value' => '1', 'label' => __('Blue')],
            ['value' => '2', 'label' => __('Green')],
        ];
    }
}
