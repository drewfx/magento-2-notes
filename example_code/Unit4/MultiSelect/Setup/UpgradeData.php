<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit4\MultiSelect\Setup;
use Magento\Catalog\Model\Product;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute as CatalogAttribute;


/**
 * Class UpgradeData
 * @package Unit4\MultiSelect\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var CategorySetupFactory
     */
    protected $categorySetupFactory;

    /**
     * UpgradeData constructor.
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(CategorySetupFactory $categorySetupFactory)
    {
        $this->categorySetupFactory = $categorySetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '0.1.0', '<' ))
        $catalogSetup = $this->categorySetupFactory->create(['setup' => $setup]);
        $catalogSetup->addAttribute(
            Product::ENTITY,
            'custom_multiselect',
            [
                'type' => 'text',
                'label' => 'Custom multiselect attribute',
                'input' => 'multiselect',
                'required' => 0,
                'visible_on_front' => 1,
                'global' => CatalogAttribute::SCOPE_STORE,
                'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                'option' => ['values' => [
                    'left',
                    'right',
                    'up',
                    'down'
                ]]
            ]
        );

        if (version_compare($context->getVersion(), '0.2.0', '<')) {
            $catalogSetup->updateAttribute(
                Product::ENTITY,
                'custom_multiselect',
                [
                    'frontend_model' => 'Unit4\MultiSelect\Model\Entity\Attribute\Frontend\HtmlList',
                    'is_html_allowed_on_front' => 1
                ]
            );
        }
    }
}