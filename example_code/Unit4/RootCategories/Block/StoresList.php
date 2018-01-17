<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Unit4\RootCategories\Block;
use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Template
 * @package Unit4\RootCategories\Block
 */
class StoresList extends \Magento\Framework\View\Element\Template
{
    /**
     * @var CategoryInterface
     */
    protected $catalogCategory;

    /**
     * Template constructor.
     *
     * @param CategoryInterface $catalogCategory
     */
    public function __construct(CategoryInterface $catalogCategory, Context $context)
    {
        $this->catalogCategory = $catalogCategory;
        parent::__construct($context);
    }

    /**
     * @return string
     */
    public function _toHtml()
    {
        $storesList = $this->_storeManager->getStores();
        $catalogCategory = $this->catalogCategory;

        $stores = [];
        foreach ($storesList as $store) {
            $rootCategoryId = $store->getRootCategoryId();
            $categoryName = $catalogCategory
                ->load($rootCategoryId)
                ->getName();

            $stores[] = [
                'store_name' => $store->getName(),
                'root_category_name' => $categoryName
            ];
        }

        return print_r($stores, true);
    }
}