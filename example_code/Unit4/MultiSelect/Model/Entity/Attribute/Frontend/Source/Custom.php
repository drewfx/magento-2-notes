<?php
namespace Training\Unit4\Model\Entity\Attribute\Frontend\Source;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Custom extends AbstractSource
{
    public function getAllOptions()
    {
        return range(1, 10, 1);
    }
}