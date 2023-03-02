<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Client\MerchantReview;

use Generated\Shared\Transfer\MerchantReviewRequestTransfer;
use Generated\Shared\Transfer\MerchantReviewResponseTransfer;
use Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer;
use Generated\Shared\Transfer\MerchantReviewSummaryTransfer;
use Generated\Shared\Transfer\RatingAggregationTransfer;

interface MerchantReviewClientInterface
{
    /**
     * Specification:
     * - Stores provided merchant review in persistent storage with pending status.
     * - Returns the provided transfer object updated with the stored entity's data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewResponseTransfer
     */
    public function submitCustomerReview(MerchantReviewRequestTransfer $merchantReviewRequestTransfer): MerchantReviewResponseTransfer;

    /**
     * Specification:
     * - Calculates the merchant review rating aggregation value.
     * - Calculates the merchant review average rating value.
     * - Calculates the merchant total review value.
     * - Provides the merchant review available maximum rating value.
     * - Requires `MerchantReviewSummaryTransfer.ratingAggregation` property to calculate merchant review summary.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RatingAggregationTransfer $ratingAggregationTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewSummaryTransfer
     */
    public function calculateMerchantReviewSummary(RatingAggregationTransfer $ratingAggregationTransfer): MerchantReviewSummaryTransfer;
}
