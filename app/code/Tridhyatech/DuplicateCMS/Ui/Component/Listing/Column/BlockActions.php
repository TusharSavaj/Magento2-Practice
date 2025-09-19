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
use Magento\Ui\Component\Listing\Columns\Column;
use Tridhyatech\DuplicateCMS\ViewModel\ConfigData;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

/**
 * Class to build edit and delete link for each item.
 */
class BlockActions extends Column
{
    /**
     * Url path
     */
    public const URL_PATH_EDIT = 'cms/block/edit';
    public const URL_PATH_DELETE = 'cms/block/delete';
    public const URL_PATH_DETAILS = 'cms/block/details';
    public const URL_PATH_DUPLICATE = 'duplicatecms/block/index';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * @var ConfigData
     */
    private $configData;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param Escaper $escaper
     * @param ConfigData $configData
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        Escaper $escaper,
        ConfigData $configData,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->escaper = $escaper;
        $this->configData = $configData;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['block_id'])) {
                    $title = $this->escaper->escapeHtmlAttr($item['title']);
                    if (!$this->configData->isEnabled()) {
                        $item[$this->getData('name')] = [
                            'edit' => [
                                'href' => $this->urlBuilder->getUrl(
                                    static::URL_PATH_EDIT,
                                    [
                                        'block_id' => $item['block_id']
                                    ]
                                ),
                                'label' => __('Edit')
                            ],
                            'delete' => [
                                'href' => $this->urlBuilder->getUrl(
                                    static::URL_PATH_DELETE,
                                    [
                                        'block_id' => $item['block_id']
                                    ]
                                ),
                                'label' => __('Delete'),
                                'confirm' => [
                                    'title' => __('Delete %1', $title),
                                    'message' => __('Are you sure you want to delete a %1 record?', $title)
                                ],
                                'post' => true
                            ],
                        ];
                    }
                    if ($this->configData->isEnabled()) {
                        $item[$this->getData('name')] = [
                            'edit' => [
                                'href' => $this->urlBuilder->getUrl(
                                    static::URL_PATH_EDIT,
                                    [
                                        'block_id' => $item['block_id']
                                    ]
                                ),
                                'label' => __('Edit')
                            ],
                            'delete' => [
                                'href' => $this->urlBuilder->getUrl(
                                    static::URL_PATH_DELETE,
                                    [
                                        'block_id' => $item['block_id']
                                    ]
                                ),
                                'label' => __('Delete'),
                                'confirm' => [
                                    'title' => __('Delete %1', $title),
                                    'message' => __('Are you sure you want to delete a %1 record?', $title)
                                ],
                                'post' => true
                            ],
                            'duplicate' => [
                                'href' => $this->urlBuilder->getUrl(
                                    static::URL_PATH_DUPLICATE,
                                    [
                                        'block_id' => $item['block_id']
                                    ]
                                ),
                                'label' => __('Duplicate'),
                                'confirm' => [
                                    'title' => __('Duplicate %1', $title),
                                    'message' => __('Are you sure you want to duplicate a %1 record?', $title)
                                ],
                                'post' => true
                            ],
                        ];
                    }
                }
            }
        }

        return $dataSource;
    }
}
