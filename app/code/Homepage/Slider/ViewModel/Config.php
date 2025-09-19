<?php
namespace Homepage\Slider\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config implements ArgumentInterface
{
    private const CONFIG_ADDTOCART_BESTSELLER = 'slider/bestseller/add_to_cart_display';
    private const CONFIG_WISHLIST_BESTSELLER = 'slider/bestseller/wishlist_button_display';
    private const CONFIG_TITTLE_BESTSELLER = 'slider/bestseller/title';
    private const CONFIG_ENABLED_BESTSELLER = 'slider/bestseller/enabled';
    private const CONFIG_SLIDER_ITEM_BESTSELLER = 'slider/bestseller/product_slider_item';
    private const CONFIG_CLICKTOSLIDE_BESTSELLER = 'slider/bestseller/click_slide';
    private const CONFIG_TEXTCOLOR_BESTSELLER = 'slider/bestseller/background_color';
    private const CONFIG_PRODUCT_SLIDER_BESTSELLER = 'slider/bestseller/product_show';

    private const CONFIG_ADDTOCART_MOSTVIEW = 'slider/mostview/add_to_cart_display';
    private const CONFIG_WISHLIST_MOSTVIEW = 'slider/mostview/wishlist_button_display';
    private const CONFIG_TITTLE_MOSTVIEW = 'slider/mostview/title';
    private const CONFIG_ENABLED_MOSTVIEW = 'slider/mostview/enabled';
    private const CONFIG_SLIDER_ITEM_MOSTVIEW = 'slider/mostview/product_slider_item';
    private const CONFIG_CLICKTOSLIDE_MOSTVIEW = 'slider/mostview/click_slide';
    private const CONFIG_TEXTCOLOR_MOSTVIEW = 'slider/mostview/background_color';
    private const CONFIG_PRODUCT_SLIDER_MOSTVIEW = 'slider/mostview/product_show';

    private const CONFIG_ADDTOCART_FEATURE = 'slider/feature_product/add_to_cart_display';
    private const CONFIG_WISHLIST_FEATURE = 'slider/feature_product/wishlist_button_display';
    private const CONFIG_TITTLE_FEATURE = 'slider/feature_product/title';
    private const CONFIG_ENABLED_FEATURE = 'slider/feature_product/enabled';
    private const CONFIG_SLIDER_ITEM_FEATURE = 'slider/feature_product/product_slider_item';
    private const CONFIG_CLICKTOSLIDE_FEATURE = 'slider/feature_product/click_slide';
    private const CONFIG_TEXTCOLOR_FEATURE = 'slider/feature_product/background_color';
    private const CONFIG_PRODUCT_SLIDER_FEATURE = 'slider/feature_product/product_show';

    private const CONFIG_ADDTOCART_NEWPRODUCT = 'slider/new_product/add_to_cart_display';
    private const CONFIG_WISHLIST_NEWPRODUCT = 'slider/new_product/wishlist_button_display';
    private const CONFIG_TITTLE_NEWPRODUCT = 'slider/new_product/title';
    private const CONFIG_ENABLED_NEWPRODUCT = 'slider/new_product/enabled';
    private const CONFIG_SLIDER_ITEM_NEWPRODUCT = 'slider/new_product/product_slider_item';
    private const CONFIG_CLICKTOSLIDE_NEWPRODUCT = 'slider/new_product/click_slide';
    private const CONFIG_TEXTCOLOR_NEWPRODUCT = 'slider/new_product/background_color';
    private const CONFIG_PRODUCT_SLIDER_NEWPRODUCT = 'slider/new_product/product_show';

    private const CONFIG_ADDTOCART_RECENT = 'slider/recent_product/add_to_cart_display';
    private const CONFIG_WISHLIST_RECENT = 'slider/recent_product/wishlist_button_display';
    private const CONFIG_TITTLE_RECENT = 'slider/recent_product/title';
    private const CONFIG_ENABLED_RECENT = 'slider/recent_product/enabled';
    private const CONFIG_SLIDER_ITEM_RECENT = 'slider/recent_product/product_slider_item';
    private const CONFIG_CLICKTOSLIDE_RECENT = 'slider/recent_product/click_slide';
    private const CONFIG_TEXTCOLOR_RECENT = 'slider/recent_product/background_color';
    private const CONFIG_PRODUCT_SLIDER_RECENT = 'slider/recent_product/product_show';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * MyViewModel constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get system configuration value programmatically.
     *
     * @return string
     */

    //BestSeller

    public function getAddToCartValueBestSeller()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ADDTOCART_BESTSELLER, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give WishListValue in Bestseller
     *
     * @return void
     */
    public function getWishlistValueBestSeller()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_WISHLIST_BESTSELLER, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give Slider Title in BestSeller
     *
     * @return void
     */
    public function getSliderTitleBestSeller()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TITTLE_BESTSELLER, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give Enabled True/False in bestseller
     *
     * @return void
     */
    public function getEnabledBestSeller()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ENABLED_BESTSELLER, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give SliderItem in bestseller
     *
     * @return void
     */
    public function getSliderItemBestSeller()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_SLIDER_ITEM_BESTSELLER, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give ClickSlider To Slide in bestseller
     *
     * @return void
     */
    public function getClickSliderBestSeller()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_CLICKTOSLIDE_BESTSELLER, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give TitleColor in BestSeller
     *
     * @return void
     */
    public function getTittleColorBestSeller()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TEXTCOLOR_BESTSELLER, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give ProductItems in bestseller
     *
     * @return void
     */
    public function getProductItemsBestSeller()
    {
        $configValue = $this->scopeConfig->getValue(
            self::CONFIG_PRODUCT_SLIDER_BESTSELLER,
            ScopeInterface::SCOPE_STORE
        );

        return $configValue;
    }

    //MostView
    /**
     * Give AddToCart in MostViewProduct
     *
     * @return void
     */
    public function getAddToCartValueMostView()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ADDTOCART_MOSTVIEW, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give WishlistValue in MostViewProduct
     *
     * @return void
     */
    public function getWishlistValueMostView()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_WISHLIST_MOSTVIEW, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give SliderTitle in MostViewProduct
     *
     * @return void
     */
    public function getSliderTitleMostView()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TITTLE_MOSTVIEW, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give Enabled True/False in MostViewProduct
     *
     * @return void
     */
    public function getEnabledMostView()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ENABLED_MOSTVIEW, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give SliderItem in MostViewProduct
     *
     * @return void
     */
    public function getSliderItemMostView()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_SLIDER_ITEM_MOSTVIEW, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give ClickSlider in MostViewProduct
     *
     * @return void
     */
    public function getClickSliderMostView()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_CLICKTOSLIDE_MOSTVIEW, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give titlecolor in MostViewProduct
     *
     * @return void
     */
    public function getTittleColorMostView()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TEXTCOLOR_MOSTVIEW, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give ProductItems in MostViewProduct
     *
     * @return void
     */
    public function getProductItemsMostView()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_PRODUCT_SLIDER_MOSTVIEW, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }

    //Recent Product
    /**
     * Give AddToCartValue in RecentOrder
     *
     * @return void
     */
    public function getAddToCartValueRecent()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ADDTOCART_RECENT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give WishlistValue in RecentOrder
     *
     * @return void
     */
    public function getWishlistValueRecent()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_WISHLIST_RECENT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give SliderTitle in RecentOrder
     *
     * @return void
     */
    public function getSliderTitleRecent()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TITTLE_RECENT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give Enabled True/False in RecentOrder
     *
     * @return void
     */
    public function getEnabledRecent()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ENABLED_RECENT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give SliderItem in RecentOrder
     *
     * @return void
     */
    public function getSliderItemRecent()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_SLIDER_ITEM_RECENT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give ClickSlider to Slide in RecentOrder
     *
     * @return void
     */
    public function getClickSliderRecent()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_CLICKTOSLIDE_RECENT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give TitleColor in RecentOrder
     *
     * @return void
     */
    public function getTittleColorRecent()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TEXTCOLOR_RECENT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give ProductItems in RecentOrder
     *
     * @return void
     */
    public function getProductItemsRecent()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_PRODUCT_SLIDER_RECENT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }

    //New Product
    /**
     * Give AddToCartValue in NewProduct
     *
     * @return void
     */
    public function getAddToCartValueNewProduct()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ADDTOCART_NEWPRODUCT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give WishlistValue in NewProduct
     *
     * @return void
     */
    public function getWishlistValueNewProduct()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_WISHLIST_NEWPRODUCT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give SliderTitle in NewProduct
     *
     * @return void
     */
    public function getSliderTitleNewProduct()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TITTLE_NEWPRODUCT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give Enabled True/False in NewProduct
     *
     * @return void
     */
    public function getEnabledNewProduct()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ENABLED_NEWPRODUCT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give SliderItem in NewProduct
     *
     * @return void
     */
    public function getSliderItemNewProduct()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_SLIDER_ITEM_NEWPRODUCT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give ClickSlider to Slide in NewProduct
     *
     * @return void
     */
    public function getClickSliderNewProduct()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_CLICKTOSLIDE_NEWPRODUCT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give TitleColor in NewProduct
     *
     * @return void
     */
    public function getTittleColorNewProduct()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TEXTCOLOR_NEWPRODUCT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give ProductItems in NewProduct
     *
     * @return void
     */
    public function getProductItemsNewProduct()
    {
        $configValue = $this->scopeConfig->getValue(
            self::CONFIG_PRODUCT_SLIDER_NEWPRODUCT,
            ScopeInterface::SCOPE_STORE
        );

        return $configValue;
    }

    //Feature Product
    /**
     * Give AddtoCartValue in Feature
     *
     * @return void
     */
    public function getAddToCartValueFeature()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ADDTOCART_FEATURE, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give WishlistValue in Feature
     *
     * @return void
     */
    public function getWishlistValueFeature()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_WISHLIST_FEATURE, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give SliderTitle in Feature
     *
     * @return void
     */
    public function getSliderTitleFeature()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TITTLE_FEATURE, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give Enabled True/False in Feature
     *
     * @return void
     */
    public function getEnabledFeature()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ENABLED_FEATURE, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give SliderItem in Feature
     *
     * @return void
     */
    public function getSliderItemFeature()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_SLIDER_ITEM_FEATURE, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give Click to Slide in Feature
     *
     * @return void
     */
    public function getClickSliderFeature()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_CLICKTOSLIDE_FEATURE, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give TitleColor in Feature
     *
     * @return void
     */
    public function getTittleColorFeature()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TEXTCOLOR_FEATURE, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give ProductItems in Feature
     *
     * @return void
     */
    public function getProductItemsFeature()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_PRODUCT_SLIDER_FEATURE, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
}
