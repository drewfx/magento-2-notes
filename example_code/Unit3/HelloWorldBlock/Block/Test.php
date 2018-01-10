<?php
/**
 * ACL. Can be queried for relations between roles and resources.
 *
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit3\HelloWorldBlock\Block;

/**
 * Class Test
 * @package Unit3\HelloWorldBlock\Block
 */
class Test extends \Magento\Framework\View\Element\AbstractBlock
{
    /**
     * @return string
     */
    protected function _toHtml()
    {
        return "<b>Hello world from the block!</b>";
    }
}