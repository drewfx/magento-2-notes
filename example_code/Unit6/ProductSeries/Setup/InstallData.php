<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Unit6\ProductSeries\Setup;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData
 * @package Unit6\ProductSeries\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var EavSetup
     */
    protected $eavSetup;

    /**
     * InstallData constructor.
     * @param EavSetup $eavSetup
     */
    public function __construct(EavSetup $eavSetup) {
        $this->eavSetup = $eavSetup;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $entityTypeId = $this->eavSetup->getEntityTypeId('catalog_product');
        $attributeSetId = $this->eavSetup->getAttributeSetId($entityTypeId, 'Bag');
        $attributeGroupId = $this->eavSetup->getAttributeGroupId($entityTypeId, $attributeSetId, 'Product Details');
        $attributeCode = 'product_series';
        $properties = [
            'type' => 'varchar',
            'label' => 'Product Series',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'user_defined' => 1,
            'required' => 0,
            'visible_on_front' => 1,
            'is_used_in_grid' => 1,
            'is_visible_in_grid' => 1,
            'is_filterable_in_grid' => 1
        ];

        $this->eavSetup->addAttribute($entityTypeId, $attributeCode, $properties);
        $this->eavSetup->addAttributeToGroup($entityTypeId, $attributeSetId, $attributeGroupId, $attributeCode);
    }

}