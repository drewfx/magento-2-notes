<?php
/**
 * ACL. Can be queried for relations between roles and resources.
 *
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit5\Repository\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface ExampleRepositoryInterface
 * @package Unit5\Repository\Api
 */
interface ExampleRepositoryInterface
{
    /**
     * @return Data\ExampleSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}