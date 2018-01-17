<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\RequireVerification\Controller\Adminhtml\Order;
use Magento\Backend\App\Action;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Sales\Controller\Adminhtml\Order\AbstractMassAction;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;

/**
 * Class Verify
 * @package Unit6\Unit6Exer641\Controller\Adminhtml\Order
 */
class Verify extends AbstractMassAction
{
    /**
     * Verify constructor.
     *
     * @param Action\Context $context
     * @param Filter $filter
     * @param CollectionFactory $collection
     */
    public function __construct(Action\Context $context, Filter $filter, CollectionFactory $collection)
    {
        parent::__construct($context, $filter);
        $this->collectionFactory = $collection;
    }

    /**
     * @param AbstractCollection $collection
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    protected function massAction(AbstractCollection $collection)
    {
        foreach ($collection as $order) {
            $order->setRequireVerification(0)->save();
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath($this->getComponentRefererUrl());
        return $resultRedirect;
    }
}