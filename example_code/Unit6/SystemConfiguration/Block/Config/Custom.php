<?php
namespace Training\Unit6Exer661\Block\Config;


use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Custom extends Field
{
    protected function _getElementHtml(AbstractElement $element)
    {
        return 'Hello World from frontend mode ../';
    }

}