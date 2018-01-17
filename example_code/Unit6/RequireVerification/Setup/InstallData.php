<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\RequireVerification\Setup;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData
 * @package Training\Unit6Exer641\Setup
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
        $setup->startSetup();

        $columnName = 'require_verification';
        $definition = [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            'nullable' => true,
            'default' => 1,
            'comment' => 'Require Verification Flag'
        ];

        $tableName = $setup->getConnection()->getTableName('sales_order');
        $setup->getConnection()->addColumn($tableName, $columnName, $definition);

        $tableName = $setup->getConnection()->getTableName('sales_order_grid');
        $setup->getConnection()->addColumn($tableName, $columnName, $definition);

        $setup->endSetup();
    }

}