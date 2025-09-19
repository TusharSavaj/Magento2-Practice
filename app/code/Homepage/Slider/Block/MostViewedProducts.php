<?php
namespace Homepage\Slider\Block;

use Magento\Catalog\Pricing\Price\FinalPrice;
use Magento\Framework\Pricing\Render;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface as StoreManager;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects))
 */
/**
 * @SuppressWarnings(PHPMD.ShortVariable))
 * @SuppressWarnings(PHPMD.LongVariable))
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects))
 */
class MostViewedProducts extends \Magento\Catalog\Block\Product\AbstractProduct
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
     * @var CollectionFactory
     */
    protected $productsfactory;
    /**
     * @var StoreManager
     */
    protected $storeManager;
    /**
     * MostViewedProduct Constructor
     *
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Catalog\Model\CategoryFactory $categoryFactory
     * @param \Magento\Framework\Url\Helper\Data $urlHelper
     * @param \Magento\Catalog\Model\ProductFactory $productloader
     * @param \Magento\Framework\Data\Form\FormKey $formKey
     * @param \Magento\Reports\Model\ResourceModel\Product\CollectionFactory $productsFactory
     * @param StoreManager $storeManager
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Catalog\Model\ProductFactory $productloader,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Reports\Model\ResourceModel\Product\CollectionFactory $productsFactory,
        StoreManager $storeManager,
        array $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->categoryFactory = $categoryFactory;
        $this->urlHelper = $urlHelper;
        $this->productFactory = $productloader;
        $this->formKey = $formKey;
        $this->productsFactory = $productsFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
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
     * Give MostViewedProducts
     *
     * @return void
     */
    public function mostViewedProducts()
    {
        $currentStoreId = $this->storeManager->getStore()->getId();

        $collection = $this->productsFactory->create()
                           ->addAttributeToSelect('*')
                           ->addViewsCount()
                           ->setStoreId($currentStoreId)
                           ->addStoreFilter($currentStoreId)
                           ->setOrder('views', 'desc');

        return $collection;
    }
    /**
     * Give Product ID
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
                ActionInterface::PARAM_NAME_URL_ENCODED =>
                    $this->urlHelper->getEncodedUrl($url),
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
