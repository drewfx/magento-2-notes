<?php
/**
 *
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit1\Test\MagentoU;

/**
 * Class Test
 * @package Unit1\Test\MagentoU
 */
class Test
{
    /**
     * @var bool
     */
    protected $justAParameter;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var \Unit1\Test\Api\ProductRepositoryInterface
     */
    protected $unit1ProductRepository;

    /**
     * Test constructor.
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param \Magento\Checkout\Model\Session $session
     * @param \Unit1\Test\Api\ProductRepositoryInterface $unit1ProductRepository
     * @param bool $justAParameter
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Checkout\Model\Session $session,
        \Unit1\Test\Api\ProductRepositoryInterface $unit1ProductRepository,
        $justAParameter = false,
        array $data = []
    ) {
        $this->justAParameter = $justAParameter;
        $this->data = $data;
        $this->unit1ProductRepository = $unit1ProductRepository;
    }
}