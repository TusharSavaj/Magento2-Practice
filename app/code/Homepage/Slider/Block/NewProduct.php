<?php
namespace Homepage\Slider\Block;

use Magento\Catalog\Pricing\Price\FinalPrice;
use Magento\Framework\Pricing\Render;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects))
 */
/**
 * @SuppressWarnings(PHPMD.ShortVariable))
 * @SuppressWarnings(PHPMD.LongVariable))
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects))
 */
class NewProduct extends \Magento\Catalog\Block\Product\AbstractProduct
{
    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;
    /**
     * @var CategoryFactory
     */
    protected $categoryFactory;
    /**
     * @var TimezoneInterface
     */
    protected $timezone;
    /**
     * NewProduct Constructor
     *
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Catalog\Model\CategoryFactory $categoryFactory
     * @param \Magento\Framework\Url\Helper\Data $urlHelper
     * @param \Magento\Catalog\Model\ProductFactory $productloader
     * @param \Magento\Framework\Data\Form\FormKey $formKey
     * @param TimezoneInterface $timezone
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Catalog\Model\ProductFactory $productloader,
        \Magento\Framework\Data\Form\FormKey $formKey,
        TimezoneInterface $timezone,
        array $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->categoryFactory = $categoryFactory;
        $this->urlHelper = $urlHelper;
        $this->productFactory = $productloader;
        $this->formKey = $formKey;
        $this->timezone = $timezone;
        parent::__construct($context, $data);
    }
    /**
     * Give NewProducts Collection
     *
     * @param integer $days
     * @return void
     */
    public function getNewProducts($days = 30)
    {
        // Get the current date and calculate the date 'days' ago
        $currentDate = $this->timezone->date()->format('Y-m-d H:i:s');
        $fromDate = $this->timezone->date()->modify('-' . $days . ' days')->format('Y-m-d H:i:s');

        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*'); // Select all attributes or specific ones
        $collection->addAttributeToFilter('created_at', ['from' => $fromDate, 'to' => $currentDate]);
        $collection->addAttributeToFilter(
            'status',
            \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED
        );
        $collection->setPageSize(27); // Limit the number of products (optional)
        $collection->setOrder('created_at', 'DESC'); // Order by creation date descending

        return $collection;
    }
    /**
     * Give Product Collection
     *
     * @return void
     */
    public function getProductCollection()
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('type_id', ['eq' => 'simple']);
        $collection->getSelect()->order('created_at', \Magento\Framework\DB\Select::SQL_DESC);
        $collection->getSelect()->limit(10);
        return $collection;
    }
    /**
     * Give LoadProduct ID
     *
     * @param [type] $id
     * @return void
     */
    public function getLoadProduct($id)
    {
        return $this->productFactory->create()->load($id);
    }
    /**
     * Give AddToCartPostParams
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return void
     */
    public function getAddToCartPostParams(\Magento\Catalog\Model\Product $product)
    {
        $url = $this->getAddToCartUrl($product, ['_escape' => false]);
        return [
            'action' => $url,
            'data' => [
                'product' => (int) $product->getEntityId(),
                ActionInterface::PARAM_NAME_URL_ENCODED => $this->urlHelper->getEncodedUrl($url),
            ]
        ];
    }
    /**
     * Give ProductPrice
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return void
     */
    public function getProductPrice(\Magento\Catalog\Model\Product $product)
    {
        $priceRender = $this->getLayout()->getBlock('product.price.render.default');
        if (!$priceRender) {
            $priceRender = $this->getLayout()->createBlock(\Magento\Framework\Pricing\Render::class)
                ->setData('area', 'frontend')
                ->setData('price_render_handle', 'catalog_product_prices');
        }

        return $priceRender->render(
            FinalPrice::PRICE_CODE,
            $product,
            [
                'include_container' => true,
                'display_minimal_price' => true,
                'zone' => Render::ZONE_ITEM_LIST,
            ]
        );
    }
}
