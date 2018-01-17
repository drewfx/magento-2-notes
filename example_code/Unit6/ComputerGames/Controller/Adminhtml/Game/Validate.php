<?php
/**
 *  Copyright © 2017 Magento. All rights reserved.
 *  See COPYING.txt for license details.
 */

namespace Unit6\ComputerGames\Controller\Adminhtml\Game;
use Magento\Backend\App\Action;

/**
 * Class Validate
 * @package Training\Unit6Exer644\Controller\Adminhtml\Game
 */
class Validate extends Action
{
    /**
     * Validator
     */
    public function execute()
    {
        $this->getResponse()->appendBody(json_encode(true));
        $this->getResponse()->sendResponse();
    }
}