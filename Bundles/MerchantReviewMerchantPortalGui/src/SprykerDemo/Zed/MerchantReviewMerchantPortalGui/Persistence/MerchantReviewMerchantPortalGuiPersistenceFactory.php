<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence;

use Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\MerchantReviewMerchantPortalGuiDependencyProvider;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\Propel\MerchantReviewTableDataMapper;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\Propel\PropelModelPagerMapper;

class MerchantReviewMerchantPortalGuiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    public function getMerchantReviewPropelQuery(): SpyMerchantReviewQuery
    {
        return $this->getProvidedDependency(MerchantReviewMerchantPortalGuiDependencyProvider::PROPEL_QUERY_MERCHANT_REVIEW);
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\Propel\PropelModelPagerMapper
     */
    public function createPropelModelPagerMapper(): PropelModelPagerMapper
    {
        return new PropelModelPagerMapper();
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\Propel\MerchantReviewTableDataMapper
     */
    public function createMerchantReviewTableDataMapper(): MerchantReviewTableDataMapper
    {
        return new MerchantReviewTableDataMapper();
    }
}
