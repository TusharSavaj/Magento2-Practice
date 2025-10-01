<?php

declare(strict_types=1);

namespace SparesZone\ContactUs\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Index extends Action implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPage = false;

    /**
     * @var Context
     */
    protected $context;

    /**
     * Contact view constuctor
     *
     * @param Context $context
     * @param PageFactory $resultPage
     */
    public function __construct(
        Context $context,
        PageFactory $resultPage
    ) {
        parent::__construct($context);
        $this->resultPage = $resultPage;
    }

    /**
     * Execute method
     *
     * @return void
     */
    public function execute()
    {
        $resultPage = $this->resultPage->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Contacts Management')));
        return $resultPage;
    }
}
