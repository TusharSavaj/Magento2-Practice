<?php
namespace Homepage\Slider\Block;

use Magento\Catalog\Pricing\Price\FinalPrice;
use Magento\Framework\Pricing\Render;
use Magento\Framework\App\ActionInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollectionFactory;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects))
 */
/**
 * @SuppressWarnings(PHPMD.ShortVariable))
 * @SuppressWarnings(PHPMD.LongVariable))
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects))
 */
class RecentOrder extends \Magento\Catalog\Block\Product\AbstractProduct
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
     * @var ProductRepository
     */
    protected $productRepository;
    /**
     * @var CustomerSession
     */
    protected $customerSession;
    /**
     * @var OrderCollectionFactory
     */
    protected $orderCollectionFactory;
    /**
     * RecentOrder Constructor
     *
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Catalog\Model\CategoryFactory $categoryFactory
     * @param \Magento\Framework\Url\Helper\Data $urlHelper
     * @param \Magento\Catalog\Model\ProductFactory $productloader
     * @param \Magento\Catalog\Model\ProductRepository $productRepository
     * @param CustomerSession $customerSession
     * @param OrderCollectionFactory $orderCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Catalog\Model\ProductFactory $productloader,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        CustomerSession $customerSession,
        OrderCollectionFactory $orderCollectionFactory,
        array $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->categoryFactory = $categoryFactory;
        $this->urlHelper = $urlHelper;
        $this->productFactory = $productloader;
        $this->productRepository = $productRepository;
        $this->customerSession = $customerSession;
        $this->orderCollectionFactory = $orderCollectionFactory;

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
     * Give CustomerLoggedIn True/False
     *
     * @return boolean
     */
    public function isCustomerLoggedIn(): bool
    {
        return $this->customerSession->isLoggedIn();
    }
    /**
     * Give LogginCustomerId
     *
     * @return void
     */
    public function getLogginCustomerId()
    {
        return $this->customerSession->getCustomerId();
    }
    /**
     * Give RecentOrders Collection
     *
     * @param integer $limit
     * @return void
     */
    public function getRecentOrders($limit = 10)
    {
            $customerId = $this->customerSession->getCustomerId();

            $orderCollection = $this->orderCollectionFactory->create()
                ->addFieldToSelect('*')
                ->addFieldToFilter('customer_id', $customerId)
                ->setOrder('created_at', 'desc')
                ->setPageSize($limit);

            $productIds = [];

        foreach ($orderCollection as $order) {
            foreach ($order->getAllVisibleItems() as $item) {
                $productIds[] = (int) $item->getProductId();
            }
        }

            $productIds = array_unique($productIds);

        if (empty($productIds)) {
            return [];
        }
            
            $collection = $this->productCollectionFactory->create();
            $collection->addAttributeToSelect('*');
            $collection->addFieldToFilter('entity_id', ['in' => $productIds]);

            return $collection;
    }
    /**
     * Give LoadProducts ID
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
