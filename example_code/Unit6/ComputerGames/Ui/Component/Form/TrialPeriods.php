<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\ComputerGames\Ui\Component\Form;

/**
 * Class TrialPeriods
 * @package Unit6\ComputerGames\Ui\Component\Form
 */
class TrialPeriods implements \Magento\Framework\Data\OptionSourceInterface
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
                'label' => 'No',
                'value' => '0'
            ),
            array(
                'label' => 'Month',
                'value' => '1'
            ),
            array(
                'label' => '2 Months',
                'value' => '2'
            ),
            array(
                'label' => '6 Months',
                'value' => '6'
            ),
            array(
                'label' => 'Year',
                'value' => '12'
            )
        );

        return $this->options;
    }
}
