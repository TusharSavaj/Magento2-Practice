<?php

namespace SparesZone\ContactUs\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\File\Csv;
use SparesZone\ContactUs\Model\ResourceModel\ContactUs\CollectionFactory;

class Export extends Action
{
    /**
     * @var FileFactory
     */
    protected $fileFactory;

    /**
     * @var Csv
     */
    protected $csvProcessor;

    /**
     * @var DirectoryList
     */
    protected $directoryList;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context $context
     * @param FileFactory $fileFactory
     * @param Csv $csvProcessor
     * @param DirectoryList $directoryList
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        FileFactory $fileFactory,
        Csv $csvProcessor,
        DirectoryList $directoryList,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->fileFactory = $fileFactory;
        $this->csvProcessor = $csvProcessor;
        $this->directoryList = $directoryList;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $contactId = $this->getRequest()->getParam("contact_id");
        $item = $this->collectionFactory->create()->addFieldToFilter('contact_id', $contactId)->getFirstItem();

        $fileName = $item->getName() . '.csv';
        $filePath = $this->directoryList->getPath(DirectoryList::VAR_DIR) . '/' . $fileName;

        // Define CSV headers
        $header = ['Contact ID', 'Name', 'Email', 'Mobile Number', 'Comment', 'Created At'];

        // Prepare the data to export
        $data = [
            $header,
            [
                $item->getId(),
                $item->getName(),
                $item->getEmail(),
                $item->getMobileNumber(),
                $item->getComment(),
                $item->getCreatedAt()
            ]
        ];

        // Save CSV data to the specified path
        $this->csvProcessor->saveData($filePath, $data);

        // Create and return the file
        return $this->fileFactory->create(
            $fileName,
            file_get_contents($filePath),
            DirectoryList::VAR_DIR,
            'application/octet-stream'
        );
    }
}
