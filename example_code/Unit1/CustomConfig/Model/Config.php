<?php
/**
 * ACL. Can be queried for relations between roles and resources.
 *
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit1\CustomConfig\Model;


/**
 * Class Config
 * @package Unit1\CustomConfig\Model
 */
class Config extends \Magento\Framework\Config\Data implements \Unit1\CustomConfig\Model\Config\ConfigInterface
{
    /**
     * Config constructor.
     * @param \Unit1\CustomConfig\Model\Config\Reader $reader
     * @param \Magento\Framework\Config\CacheInterface $cache
     * @param string $cacheId
     */
    public function __construct(
        \Unit1\CustomConfig\Model\Config\Reader $reader,
        \Magento\Framework\Config\CacheInterface $cache,
        $cacheId = 'test_config'
    )
    {
        parent::__construct($reader, $cache, $cacheId);
    }

    /**
     * @return array|mixed|null
     */
    public function getMyNodeInfo()
    {
        return $this->get();
    }
}