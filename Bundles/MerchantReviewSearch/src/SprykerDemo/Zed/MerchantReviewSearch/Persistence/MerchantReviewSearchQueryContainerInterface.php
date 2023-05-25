<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Persistence;

use Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery;
use Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearchQuery;
use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface MerchantReviewSearchQueryContainerInterface extends QueryContainerInterface
{
    /**
     * Specification:
     * - TODO: Add method specification.
     *
     * @api
     *
     * @param array $merchantReviewIds
     *
     * @return \Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearchQuery
     */
    public function queryMerchantReviewSearchByIds(array $merchantReviewIds): SpyMerchantReviewSearchQuery;

    /**
     * Specification:
     * - TODO: Add method specification.
     *
     * @api
     *
     * @param array $merchantReviewIds
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    public function queryMerchantReviewsByIdMerchantReviews(array $merchantReviewIds): SpyMerchantReviewQuery;
}
