<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\ComputerGames\Model\ResourceModel;

/**
 * Class Game
 * @package Training\Unit6Exer644\Model\ResourceModel
 */
class Game extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init('computer_games', 'game_id');
    }
}
