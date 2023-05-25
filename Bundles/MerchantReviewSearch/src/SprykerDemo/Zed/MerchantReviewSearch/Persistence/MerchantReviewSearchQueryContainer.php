<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Persistence;

use Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery;
use Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearchQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchPersistenceFactory getFactory()
 */
class MerchantReviewSearchQueryContainer extends AbstractQueryContainer implements MerchantReviewSearchQueryContainerInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $merchantReviewIds
     *
     * @return \Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearchQuery
     */
    public function queryMerchantReviewSearchByIds(array $merchantReviewIds): SpyMerchantReviewSearchQuery
    {
        return $this
            ->getFactory()
            ->createSpyMerchantReviewSearchQuery()
            ->filterByFkMerchantReview_In($merchantReviewIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $merchantReviewIds
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    public function queryMerchantReviewsByIdMerchantReviews(array $merchantReviewIds): SpyMerchantReviewQuery
    {
        return $this->getFactory()
            ->getMerchantReviewQuery()
            ->queryMerchantReview()
            ->filterByIdMerchantReview_In($merchantReviewIds);
    }
}
