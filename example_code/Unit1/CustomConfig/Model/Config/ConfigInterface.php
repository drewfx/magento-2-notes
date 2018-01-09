<?php
/**
 * ACL. Can be queried for relations between roles and resources.
 *
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit1\CustomConfig\Model\Config;

/**
 * Interface ConfigInterface
 * @package Unit1\CustomConfig\Model\Config
 */
interface ConfigInterface
{
    /**
     * @return mixed
     */
    public function getMyNodeInfo();
}