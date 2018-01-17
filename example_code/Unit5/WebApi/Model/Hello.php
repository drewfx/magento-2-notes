<?php
/**
 * ACL. Can be queried for relations between roles and resources.
 *
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit5\WebApi\Model;

use Unit5\WebApi\Api\Data;

/**
 * Class Hello
 * @package Unit5\WebApi\Model
 */
class Hello implements \Unit5\WebApi\Api\Data\HelloInterface
{
    /**
     * @return string
     */
    public function sayHello() {
        return "HELLO WORLD!";
    }
}