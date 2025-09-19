<?php

namespace Sample\Crud\Model\Contact\Source;

class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var Contact
     */
    protected $contact;
    /**
     * Status Constructor
     *
     * @param \Sample\Crud\Model\Contact $contact
     */
    public function __construct(
        \Sample\Crud\Model\Contact $contact
    ) {
        $this->contact = $contact;
    }
    /**
     * Give Option Array
     *
     * @return void
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->getOptionArray();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
    /**
     * Give Option Enable/Disable
     *
     * @return void
     */
    public static function getOptionArray()
    {
        return [
            1 => __('Enabled'),
            0 => __('Disabled')
        ];
    }
}
