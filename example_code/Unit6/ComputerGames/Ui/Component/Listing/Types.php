<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\ComputerGames\Ui\Component\Listing;
class Types implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {

        $this->options = array(
            array(
                'label' => 'RPG',
                'value' => 'RPG'
            ),
            array(
                'label' => 'RTS',
                'value' => 'RTS'
            ),
            array(
                'label' => 'MMO',
                'value' => 'MMO'
            ),
            array(
                'label' => 'Simulator',
                'value' => 'Simulator'
            ),
            array(
                'label' => 'Shooter',
                'value' => 'Shooter'
            )
        );

        return $this->options;
    }
}
