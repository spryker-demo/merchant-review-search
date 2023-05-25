<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Persistence;

use Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery;
use Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearchQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewQueryContainerInterface;
use SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchDependencyProvider;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchQueryContainerInterface getQueryContainer()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchRepositoryInterface getRepository()
 */
class MerchantReviewSearchPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearchQuery
     */
    public function createSpyMerchantReviewSearchQuery(): SpyMerchantReviewSearchQuery
    {
        return SpyMerchantReviewSearchQuery::create();
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewQueryContainerInterface
     */
    public function getMerchantReviewQuery(): MerchantReviewQueryContainerInterface
    {
        return $this->getProvidedDependency(MerchantReviewSearchDependencyProvider::QUERY_CONTAINER_MERCHANT_REVIEW);
    }

    /**
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    public function getPropelMerchantReviewQuery(): SpyMerchantReviewQuery
    {
        return $this->getProvidedDependency(MerchantReviewSearchDependencyProvider::QUERY_MERCHANT_REVIEW);
    }
}
