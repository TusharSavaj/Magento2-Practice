<?php

namespace SparesZone\ContactUS\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class ContactActions extends Column
{
    public const CONTACTUS_URL_PATH_DELETE = 'contactus/contact/delete';
    public const CONTACTUS_URL_PATH_EXPORT = 'contactus/contact/export';
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;
   /**
    * ContactAction Constructor
    *
    * @param Escaper $escaper
    * @param ContextInterface $context
    * @param UiComponentFactory $uiComponentFactory
    * @param UrlInterface $urlBuilder
    * @param array $components
    * @param array $data
    */
    public function __construct(
        Escaper $escaper,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
    ) {
        $this->escaper = $escaper;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    /**
     * Give DataSource
     *
     * @param array $dataSource
     * @return void
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['contact_id'])) {
                    $title = $this->escaper->escapeHtmlAttr($item['name']);
                    $item[$this->getData('name')] = [
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::CONTACTUS_URL_PATH_DELETE,
                                [
                                    'contact_id' => $item['contact_id'],
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete %1', $title),
                                'message' => __('Are you sure you want to delete a %1 record?', $title),
                            ],
                            'post' => true,
                            '__disableTmpl' => true,
                        ],
                        'export' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::CONTACTUS_URL_PATH_EXPORT,
                                [
                                    'contact_id' => $item['contact_id'],
                                ]
                            ),
                            'label' => __('Export CSV'),
                            'hidden' => false,
                        ],
                    ];
                }
            }
        }
        return $dataSource;
    }
}
