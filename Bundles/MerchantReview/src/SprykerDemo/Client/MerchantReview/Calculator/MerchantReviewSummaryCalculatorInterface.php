<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Client\MerchantReview\Calculator;

use Generated\Shared\Transfer\MerchantReviewSummaryTransfer;
use Generated\Shared\Transfer\RatingAggregationTransfer;

interface MerchantReviewSummaryCalculatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RatingAggregationTransfer $ratingAggregationTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewSummaryTransfer
     */
    public function calculate(RatingAggregationTransfer $ratingAggregationTransfer): MerchantReviewSummaryTransfer;
}
