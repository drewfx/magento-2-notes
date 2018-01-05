<?php
/**
 * ACL. Can be queried for relations between roles and resources.
 *
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit1\Plugins\Plugin;

/**
 * Class AfterPricePlugin
 * @package Unit1\Plugins\Plugin
 */
class AfterPricePlugin
{
    /**
     * @param \Magento\Catalog\Model\Product $subject
     * @param $result
     * @return mixed
     */
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result + 0.5;
    }
}