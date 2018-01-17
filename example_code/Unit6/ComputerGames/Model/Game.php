<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\ComputerGames\Model;

/**
 * Class Game
 * @package Unit6\ComputerGames\Model
 */
class Game extends \Magento\Framework\Model\AbstractExtensibleModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Unit6\ComputerGames\Model\ResourceModel\Game');
    }

    /**
     * @return array
     */
    public function getCustomAttributesCodes()
    {
        return array('game_id', 'name', 'type', 'trial_period', 'release_date');
    }
}