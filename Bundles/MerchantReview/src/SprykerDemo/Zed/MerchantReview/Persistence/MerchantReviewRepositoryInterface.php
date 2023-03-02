<?php

namespace SprykerDemo\Zed\MerchantReview\Persistence;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;

/**
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewPersistenceFactory getFactory()
 */
interface MerchantReviewRepositoryInterface
{
    /**
     * @param int $idMerchantReview
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer|null
     */
    public function findMerchantReviewById(int $idMerchantReview): ?MerchantReviewTransfer;

    /**
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function getMerchantReviews(): MerchantReviewCollectionTransfer;
}
