<?php
/**
 * ACL. Can be queried for relations between roles and resources.
 *
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit1\Plugins\Plugin;

class AroundBreadcrumbsPlugin
{
    public function aroundAddCrumb(\Magento\Theme\Block\Html\Breadcrumbs $subject, callable $proceed, $crumbName, $crumbInfo)
    {
        $crumbInfo['label'] = $crumbInfo['label'].'(!)';
        $proceed($crumbName, $crumbInfo);
    }
}