<?php
namespace Sample\Crud\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class MyViewModel implements ArgumentInterface
{
    public const CONFIG_ISENABLED_ADDRECORD = 'sample/addrecord/enabled';
    public const CONFIG_TITLE_ADDRECORD = 'sample/addrecord/title';
    public const CONFIG_TEXT_BG_ADDRECORD = 'sample/addrecord/text_background_color';
    public const CONFIG_BG_ADDRECORD = 'sample/addrecord/background_color';

    public const CONFIG_ISENABLED_EDIT = 'sample/edit/enabled';
    public const CONFIG_TITLE_EDIT = 'sample/edit/text_background_color';
    public const CONFIG_TEXT_BG_EDIT = 'sample/edit/title';
    public const CONFIG_BG_EDIT = 'sample/edit/background_color';

    public const CONFIG_ISENABLED_DELETE = 'sample/delete/enabled';
    public const CONFIG_TITLE_DELETE = 'sample/delete/title';
    public const CONFIG_TEXT_BG_DELETE = 'sample/delete/text_background_color';
    public const CONFIG_BG_DELETE = 'sample/delete/background_color';
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

    //Add Record

    /**
     * Give AddRecordEnable
     *
     * @return void
     */
    public function getAddRecordEnabled()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ISENABLED_ADDRECORD, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give AddRecordTitle
     *
     * @return void
     */
    public function getAddRecordTitle()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TITLE_ADDRECORD, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give AddRecordTextBg
     *
     * @return void
     */
    public function getAddRecordTextBg()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TEXT_BG_ADDRECORD, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give ArecordBg
     *
     * @return void
     */
    public function getAddRecordBg()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_BG_ADDRECORD, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }

    //Edit

    /**
     * Give EditEnable
     *
     * @return void
     */
    public function getEditEnabled()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ISENABLED_EDIT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give EditTitle
     *
     * @return void
     */
    public function getEditTitle()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TITLE_EDIT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give EditTextBg
     *
     * @return void
     */
    public function getEditTextBg()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TEXT_BG_EDIT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give EditBG
     *
     * @return void
     */
    public function getEditBg()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_BG_EDIT, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }

    //Delete

    /**
     * Give DeleteEnabled
     *
     * @return void
     */
    public function getDeleteEnable()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_ISENABLED_DELETE, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give DeleteTitle
     *
     * @return void
     */
    public function getDeleteTitle()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TITLE_DELETE, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give DeleteTextBg
     *
     * @return void
     */
    public function getDeleteTextBg()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_TEXT_BG_DELETE, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
    /**
     * Give Delete Bg
     *
     * @return void
     */
    public function getDeleteBg()
    {
        $configValue = $this->scopeConfig->getValue(self::CONFIG_BG_DELETE, ScopeInterface::SCOPE_STORE);

        return $configValue;
    }
}
