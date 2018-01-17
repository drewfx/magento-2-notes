<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\ComputerGames\Controller\Adminhtml\Grid;
use Magento\Backend\App\Action;

/**
 * Class Index
 * @package Unit6\ComputerGames\Controller\Adminhtml\Grid
 */
class Index extends Action
{
    /**
     * Verify permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_Cms::page');
    }


    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->resultFactory->create('page');
    }

}