<?php

namespace Homepage\Slider\Model\Config\Source;
 
class DisplayType implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Slider View Option
     *
     * @return void
     */
    public function toOptionArray()
    {
        //returning value to the config dropdown
        return [
            ['value' => 0, 'label' => __('Grid')],
            ['value' => 1, 'label' => __('Slider')],
            ['value' => 2, 'label' => __('Sidebar')]
        ];
    }
}
