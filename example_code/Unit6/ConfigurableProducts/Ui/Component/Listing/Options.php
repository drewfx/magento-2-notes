<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\ConfigurableProducts\Ui\Component\Listing;
use Magento\Framework\Data\OptionSourceInterface;

class Options implements OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $this->options = [
            ['label' => ' ', 'value' => '0'],
            ['label' => 'One', 'value' => '1'],
            ['label' => 'Two', 'value' => '2'],
            ['label' => 'Tree', 'value' => '3']
        ];

        return $this->options;
    }
}