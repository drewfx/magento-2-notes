<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit4\VendorEntity\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    const TRAINING_VENDOR_ENTITY = 'vendor_entity';

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $install = $setup;

        $newTable = $install->getConnection()->newTable(self::TRAINING_VENDOR_ENTITY);
        $newTable->addColumn('vendor_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Vendor ID'
        )->addColumn('vendor_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            150,
            ['nullable' => false],
            'Vendor Name'
        )->addColumn('vendor_contact',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            ['nullable' => false],
            'Vendor Contacts'
            );
        $install->getConnection()->createTable($newTable);
    }
}