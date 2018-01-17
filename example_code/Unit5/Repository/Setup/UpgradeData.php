<?php
/**
 * ACL. Can be queried for relations between roles and resources.
 *
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit5\Repository\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

/**
 * Class UpgradeData
 * @package Unit5\Repository\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $dbVersion = $context->getVersion();
        if (version_compare($dbVersion, '0.1.1', '<')) {
            $tableName = $setup->getTable('training_repository_example');
            $setup->getConnection()->insertMultiple(
                $tableName,
                [
                    ['name' => 'Foo'],
                    ['name' => 'Bar'],
                    ['name' => 'Baz'],
                    ['name' => 'Qux'],
                ]
            );
        }
    }
}