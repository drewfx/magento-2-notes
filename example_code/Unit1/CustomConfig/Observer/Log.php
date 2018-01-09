<?php
/**
 *
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit1\CustomConfig\Observer;

/**
 * Class Log
 * @package Unit1\LogPathInfo\Observer
 */
class Log implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $_logger;

    /**
     * @var \Unit1\CustomConfig\Model\Config\ConfigInterface
     */
    private $config;

    /**
     * Log constructor.
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Unit1\CustomConfig\Model\Config\ConfigInterface $config
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Unit1\CustomConfig\Model\Config\ConfigInterface $config
    )
    {
        $this->_logger = $logger;
        $this->config = $config;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $myNodeInfo = $this->config->getMyNodeInfo();
        if (is_array($myNodeInfo)) {
            foreach($myNodeInfo as $str) {
                $this->_logger->critical(
                    $str
                );
            }
        }
    }
}