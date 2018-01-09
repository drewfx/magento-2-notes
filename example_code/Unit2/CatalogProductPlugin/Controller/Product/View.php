<?php
/**
 * ACL. Can be queried for relations between roles and resources.
 *
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit2\CatalogProductPlugin\Controller\Product;

/**
 * Class View
 * @package Unit2\CatalogProductPlugin\Controller\Product
 */
class View extends \Magento\Framework\App\Action\Action
{

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
       return parent::execute();
    }

    /**
     * @param \Magento\Catalog\Controller\Product\View $controller
     * @param $result
     * @return mixed
     */
    public function afterExecute(\Magento\Catalog\Controller\Product\View $controller, $result)
    {
        echo ' echo after plugin ';

        return $result;
    }
}