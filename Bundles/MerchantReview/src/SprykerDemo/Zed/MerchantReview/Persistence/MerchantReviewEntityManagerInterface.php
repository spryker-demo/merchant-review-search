<?php

namespace SprykerDemo\Zed\MerchantReview\Persistence;


use Generated\Shared\Transfer\MerchantReviewTransfer;

/**
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewPersistenceFactory getFactory()
 */
interface MerchantReviewEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function createMerchantReview(MerchantReviewTransfer $merchantReviewTransfer): MerchantReviewTransfer;

    /**
     * @param int $idMerchantReview
     *
     * @return void
     */
    public function deleteMerchantReview(int $idMerchantReview): void;

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return void
     */
    public function updateMerchantReview(MerchantReviewTransfer $merchantReviewTransfer): void;
}
