<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\RequireVerification\Ui\Component\Listing;

/**
 * Class Options
 * @package Unit6\RequireVerification\Ui\Component\Listing
 */
class Options implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $this->options = [
            [
                'label' => 'From Admin',
                'value' => 0
            ],
            [
                'label' => 'From Checkout',
                'value' => 1
            ]
        ];

        return $this->options;
    }
}