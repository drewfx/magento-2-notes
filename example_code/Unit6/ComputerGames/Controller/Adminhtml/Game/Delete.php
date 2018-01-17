<?php
/**
 *  Copyright © 2017 Magento. All rights reserved.
 *  See COPYING.txt for license details.
 */
namespace Unit6\ComputerGames\Controller\Adminhtml\Game;
use Magento\Backend\App\Action;
use Unit6\ComputerGames\Model\Game;

/**
 * Class Delete
 * @package Training\Unit6Exer644\Controller\Adminhtml\Game
 */
class Delete extends Action
{
    /**
     * @var null|Game
     */
    protected $game = null;
    /**
     * Edit constructor.
     */
    public function __construct(
        Action\Context $context,
        Game $game
    )
    {
        $this->game = $game;
        parent::__construct($context);
    }

    /**
     * Save action
     */
    public function execute()
    {
        $entityId = $this->getRequest()->getParam('game_id');

        $this->game->load($entityId);
        if ($this->game->getId()) {
            $this->game->delete();
        }
        
        $this->_redirect('games/grid/index');
    }
}