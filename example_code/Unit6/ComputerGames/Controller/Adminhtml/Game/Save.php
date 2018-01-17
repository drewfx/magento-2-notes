<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Unit6\ComputerGames\Controller\Adminhtml\Game;
use Magento\Backend\App\Action;
use Unit6\ComputerGames\Model\Game;

/**
 * Class Save
 * @package Training\Unit6Exer644\Controller\Adminhtml\Game
 */
class Save extends Action
{
    /**
     * @var null|Game
     */
    protected $game = null;

    /**
     * Edit constructor.
     */
    public function __construct(Action\Context $context, Game $game)
    {
        $this->game = $game;
        parent::__construct($context);
    }

    /**
     * Save action
     */
    public function execute()
    {
        $postData = $this->getRequest()->getParam('computer_games');
        $this->game->setData($postData)->save();

        $this->_redirect('games/grid/index');
    }
}