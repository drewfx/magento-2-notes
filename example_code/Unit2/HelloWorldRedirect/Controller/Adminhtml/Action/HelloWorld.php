<?php
/**
 * ACL. Can be queried for relations between roles and resources.
 *
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit2\HelloWorldRedirect\Controller\Adminhtml\Action;

/**
 * Class HelloWorld
 * @package Unit2\HelloWorldRedirect\Controller\Adminhtml\Action
 */
class HelloWorld extends \Magento\Backend\App\Action
{
    /**
     * execute method
     */
    public function execute()
    {
        $this->_redirect('catalog/category/edit/id/38');
    }
}