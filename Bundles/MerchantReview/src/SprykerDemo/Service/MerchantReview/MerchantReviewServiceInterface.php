<?php

namespace SprykerDemo\Service\MerchantReview;

use Generated\Shared\Transfer\MerchantReviewSummaryTransfer;
use Generated\Shared\Transfer\RatingAggregationTransfer;

interface MerchantReviewServiceInterface
{
    /**
     * Specification:
     * - Calculates the merchant review rating aggregation value.
     * - Calculates the merchant review average rating value.
     * - Calculates the merchant total review value.
     * - Provides the merchant review available maximum rating value.
     * - Requires `MerchantReviewSummaryTransfer.ratingAggregation` property to calculate merchant review summary.
     *
     * @param \Generated\Shared\Transfer\RatingAggregationTransfer $ratingAggregationTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewSummaryTransfer
     * @api
     *
     */
    public function calculateMerchantReviewSummary(RatingAggregationTransfer $ratingAggregationTransfer): MerchantReviewSummaryTransfer;
}
