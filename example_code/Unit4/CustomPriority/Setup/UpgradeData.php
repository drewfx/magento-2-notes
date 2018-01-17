<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit4\CustomPriority\Setup;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;


/**
 * Class UpgradeData
 * @package Training\Unit4\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * UpgradeData constructor.
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $customerSetup->addAttribute(
            Customer::ENTITY,
            'custom_priority',
            [
                'label' => 'Priority',
                'type' => 'int',
                'input' => 'select',
                'source' => '\Unit4\CustomPriority\Model\Entity\Attribute\Frontend\Source\CustomPriority',
                'required' => 0,
                'system' => 0,
                'position' => 100,
            ]
        );
        $customerSetup->getEavConfig()
            ->getAttribute('customer', 'custom_priority')
            ->setData('used_in_forms', ['adminhtml_customer'])
            ->save();
    }
}