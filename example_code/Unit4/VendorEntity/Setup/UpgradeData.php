<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit4\VendorEntity\Setup;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

/**
 * Class UpgradeData
 * @package Unit4\VendorEntity\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $vendorTableName = \Unit4\VendorEntity\Setup\InstallSchema::TRAINING_VENDOR_ENTITY;

        $setup->startSetup();
        if (version_compare($context->getVersion(), '0.2.1', '<')) {
            if ($setup->getConnection()->isTableExists($vendorTableName)) {
                $raw = [
                    'vendor_code' => 'vendor1',
                    'vendor_contact' => '38011122333',
                    'goods_type' => 'food'
                ];
                $setup->getConnection()->insert($vendorTableName, $raw);
            }
        }
    }
}