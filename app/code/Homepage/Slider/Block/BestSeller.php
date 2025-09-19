<?php
namespace Homepage\Slider\Block;

use Magento\Catalog\Pricing\Price\FinalPrice;
use Magento\Framework\Pricing\Render;
use Magento\Framework\App\ActionInterface;
use Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory as BestsellerFactory;

/**
 * @SuppressWarnings(PHPMD.ShortVariable))
 * @SuppressWarnings(PHPMD.LongVariable))
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects))
 */
class BestSeller extends \Magento\Catalog\Block\Product\AbstractProduct
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
     * @var Data
     */
    protected $urlHelper;
    /**
     * @var ProductFactory
     */
    protected $productFactory;
    /**
     * @var FormKey
     */
    protected $formKey;
    /**
     * @var ProductRepository
     */
    protected $productRepository;
    /**
     * @var BestsellersCollectionFactory
     */
    protected $bestsellersCollectionFactory;
    /**
     * BestSeller Constructor
     *
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Catalog\Model\CategoryFactory $categoryFactory
     * @param \Magento\Framework\Url\Helper\Data $urlHelper
     * @param \Magento\Catalog\Model\ProductFactory $productloader
     * @param \Magento\Framework\Data\Form\FormKey $formKey
     * @param \Magento\Catalog\Model\ProductRepository $productRepository
     * @param BestsellersCollectionFactory $bestsellersCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Catalog\Model\ProductFactory $productloader,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        BestsellerFactory $bestsellersCollectionFactory,
        array $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->categoryFactory = $categoryFactory;
        $this->urlHelper = $urlHelper;
        $this->productFactory = $productloader;
        $this->formKey = $formKey;
        $this->bestsellersCollectionFactory = $bestsellersCollectionFactory;
        $this->productRepository = $productRepository;

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
     * Give BestSeller Product Collection
     *
     * @return void
     */
    public function bestSellerProducts()
    {
        $products = $this->bestsellersCollectionFactory->create()
            ->setPeriod('daily'); // Options: day, week, month, year

        $productIds = [];
        foreach ($products as $bestseller) {
            $productIds[] = $bestseller->getProductId();
        }

        if (empty($productIds)) {
            return $this->productCollectionFactory->create()->addAttributeToFilter(
                'entity_id',
                ['in' => [0]]
            );
        }

        $productCollection = $this->productCollectionFactory->create()
            ->addAttributeToSelect('*')
            ->setOrder('views', 'desc')
            ->addAttributeToFilter('entity_id', ['in' => $productIds]);

        return $productCollection;
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
     * Give Product Price
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
