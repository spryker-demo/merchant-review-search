<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

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
     * @api
     *
     * @param \Generated\Shared\Transfer\RatingAggregationTransfer $ratingAggregationTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewSummaryTransfer
     */
    public function calculateMerchantReviewSummary(RatingAggregationTransfer $ratingAggregationTransfer): MerchantReviewSummaryTransfer;
}
