<?php
namespace Sample\Crud\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class ContactActions extends Column
{
    public const CONTACT_URL_PATH_EDIT = 'crud/contact/edit';
    public const CONTACT_URL_PATH_DELETE = 'crud/contact/delete';
    public const CONTACT_URL_PATH_DUPLICATE = 'crud/contact/index';
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;
    /**
     * @var EditURL
     */
    private $editUrl;
    /**
     * ContactAction Constructor
     *
     * @param Escaper $escaper
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param [type] $editUrl
     */
    public function __construct(
        Escaper $escaper,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::CONTACT_URL_PATH_EDIT
    ) {
        $this->escaper = $escaper;
        $this->urlBuilder = $urlBuilder;
        $this->editUrl = $editUrl;
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
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $title = $this->escaper->escapeHtmlAttr($item['name']);
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl($this->editUrl, ['id' => $item['id']]),
                        'label' => __('Edit')
                    ];
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::CONTACT_URL_PATH_DELETE, ['id' => $item['id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete %1', $title),
                            'message' => __('Are you sure you wan\'t to delete a %1 record?', $title)
                        ]
                    ];
                    $item[$name]['duplicate'] = [
                                'href' => $this->urlBuilder->getUrl(
                                    static::CONTACT_URL_PATH_DUPLICATE,
                                    [
                                        'id' => $item['id']
                                    ]
                                ),
                                'label' => __('Duplicate'),
                                'confirm' => [
                                    'title' => __('Duplicate %1', $title),
                                    'message' => __('Are you sure you want to duplicate a %1 record?', $title)
                                ],
                                'post' => true
                            ];
                }
            }
        }

        return $dataSource;
    }
}
