<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\MerchantReview\Persistence;

/**
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewPersistenceFactory getFactory()
 */
interface MerchantReviewQueryContainerInterface
{
    /**
     * Specification:
     * - TODO: Add method specification.
     *
     * @api
     *
     * @param int $idMerchantReview
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    public function queryMerchantReviewById(int $idMerchantReview): \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery;

    /**
     * Specification:
     * - TODO: Add method specification.
     *
     * @api
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    public function queryMerchantReview(): \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery;
}
