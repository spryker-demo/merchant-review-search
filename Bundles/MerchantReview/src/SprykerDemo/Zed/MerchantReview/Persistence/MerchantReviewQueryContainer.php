<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\MerchantReview\Persistence;

use Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewPersistenceFactory getFactory()
 */
class MerchantReviewQueryContainer extends AbstractQueryContainer implements MerchantReviewQueryContainerInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idMerchantReview
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    public function queryMerchantReviewById(int $idMerchantReview): SpyMerchantReviewQuery
    {
        return $this->getFactory()
            ->createMerchantReviewQuery()
            ->filterByIdMerchantReview($idMerchantReview);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    public function queryMerchantReview(): SpyMerchantReviewQuery
    {
        return $this->getFactory()
            ->createMerchantReviewQuery();
    }
}
