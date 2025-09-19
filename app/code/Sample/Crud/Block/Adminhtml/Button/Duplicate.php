<?php

namespace Sample\Crud\Block\Adminhtml\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;
use Sample\Crud\Model\ContactFactory;
use Magento\Backend\Block\Widget\Context;

class Duplicate extends Generic implements ButtonProviderInterface
{
    /**
     * @var contactFactory
     */
    protected $contactFactory;
    /**
     * @var Context
     */
    protected $context;
    /**
     * Duplicate Constructor
     *
     * @param ContactFactory $contactFactory
     * @param Context $context
     */
    public function __construct(
        ContactFactory $contactFactory,
        Context $context
    ) {
        $this->contactFactory = $contactFactory;
        parent::__construct($context);
    }
    /**
     * Give ContactID
     *
     * @return void
     */
    public function getId()
    {
            return $this->context->getRequest()->getParam('id');
    }
    /**
     * Give ButtonData
     *
     * @return void
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getId()) {
            $data = [
                'label' => __('Duplicate Contact'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to duplicate this?'
                ) . '\', \'' . $this->getDuplicateUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
    /**
     * Give DuplicateURL
     *
     * @return void
     */
    public function getDuplicateUrl()
    {
        return $this->getUrl('crud/contact/index', ['id' => $this->getId()]);
    }
}
