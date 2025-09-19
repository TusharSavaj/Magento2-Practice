<?php

/**
 * @author Tridhyatech Team
 * @copyright Copyright (c) 2024 Tridhyatech (https://www.tridhyatech.com)
 * @package Tridhyatech_DuplicateCMS
 */

declare(strict_types=1);

namespace Tridhyatech\DuplicateCMS\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Ui\Component\Listing\Columns\Column;
use Tridhyatech\DuplicateCMS\ViewModel\ConfigData;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Cms\ViewModel\Page\Grid\UrlBuilder as ScopeUrlBuilder;
use Magento\Cms\Block\Adminhtml\Page\Grid\Renderer\Action\UrlBuilder;

/**
 * Class prepare Page Actions
 */
class PageActions extends Column
{
    /** Url path */
    public const CMS_URL_PATH_EDIT = 'cms/page/edit';
    public const CMS_URL_PATH_DELETE = 'cms/page/delete';
    public const CMS_URL_PATH_DUPLICATE = 'duplicatecms/page/index';

    /**
     * @var UrlBuilder
     */
    protected $actionUrlBuilder;

    /**
     * @var ScopeUrlBuilder
     */
    private $scopeUrlBuilder;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var string
     */
    private $editUrl;

    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * @var ConfigData
     */
    private $configData;

    /**
     * Page action constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlBuilder $actionUrlBuilder
     * @param UrlInterface $urlBuilder
     * @param Escaper $escaper
     * @param ConfigData $configData
     * @param array $components
     * @param array $data
     * @param mixed $editUrl
     * @param ScopeUrlBuilder|null $scopeUrlBuilder
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlBuilder $actionUrlBuilder,
        UrlInterface $urlBuilder,
        Escaper $escaper,
        ConfigData $configData,
        array $components = [],
        array $data = [],
        $editUrl = self::CMS_URL_PATH_EDIT,
        ScopeUrlBuilder $scopeUrlBuilder = null
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->escaper = $escaper;
        $this->actionUrlBuilder = $actionUrlBuilder;
        $this->editUrl = $editUrl;
        $this->configData = $configData;
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->scopeUrlBuilder = $scopeUrlBuilder ?: ObjectManager::getInstance()
            ->get(ScopeUrlBuilder::class);
    }

    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['page_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl($this->editUrl, ['page_id' => $item['page_id']]),
                        'label' => __('Edit'),
                    ];
                    $title = $this->escaper->escapeHtml($item['title']);
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(
                            self::CMS_URL_PATH_DELETE,
                            ['page_id' => $item['page_id']]
                        ),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete %1', $title),
                            'message' => __('Are you sure you want to delete a %1 record?', $title),
                        ],
                        'post' => true,
                    ];
                    if ($this->configData->isEnabled()) {
                        $item[$name]['duplicate'] = [
                            'href' => $this->urlBuilder->getUrl(
                                self::CMS_URL_PATH_DUPLICATE,
                                ['page_id' => $item['page_id']]
                            ),
                            'label' => __('Duplicate'),
                            'confirm' => [
                                'title' => __('Duplicate %1', $title),
                                'message' => __('Are you sure you want to duplicate %1?', $title),
                            ],
                            'post' => true,
                        ];
                    }
                }
                if (isset($item['identifier'])) {
                    $item[$name]['preview'] = [
                        'href' => $this->scopeUrlBuilder->getUrl(
                            $item['identifier'],
                            isset($item['_first_store_id']) ? $item['_first_store_id'] : null,
                            isset($item['store_code']) ? $item['store_code'] : null
                        ),
                        'label' => __('View'),
                        'target' => '_blank'
                    ];
                }
            }
        }

        return $dataSource;
    }
}
