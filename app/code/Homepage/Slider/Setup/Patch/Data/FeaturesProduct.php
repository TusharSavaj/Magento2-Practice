<?php

declare(strict_types=1);

namespace Homepage\Slider\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;

class FeaturesProduct implements DataPatchInterface
{
    /**
     * Constants block
     */
    public const ENTITY_TYPE_ID = 'catalog_product';
    public const ATTRIBUTE_CODE = 'featurecode';

    /**
     * ModuleDataSetupInterface DataSetup
     *
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    /**
     * EavSetupFactory for SetupFactory
     *
     * @var EavSetupFactory
     */
    private EavSetupFactory $eavSetupFactory;

    /**
     * FeaturesProduct constructor.
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory          $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Apply Function for attribute
     */
    public function apply(): void
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(
            self::ENTITY_TYPE_ID,
            self::ATTRIBUTE_CODE,
            [
                'group' => 'General',
                'label' => 'Features',
                'type' => 'int',
                'input' => 'boolean',
                'backend' => '',
                'frontend' => '',
                'class' => '',
                'source' => Boolean::class,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '0',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => 'simple,configurable,grouped,virtual,bundle,downloadable'
            ]
        );
    }

    /**
     * Give Dependencies
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Give Aliases
     */
    public function getAliases()
    {
        return [];
    }
}
