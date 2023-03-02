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
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerDemo\Client\MerchantReview\MerchantReviewFactory getFactory()
 */
class MerchantReviewClient extends AbstractClient implements MerchantReviewClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewResponseTransfer
     */
    public function submitCustomerReview(MerchantReviewRequestTransfer $merchantReviewRequestTransfer): MerchantReviewResponseTransfer
    {
        return $this->getFactory()
            ->createMerchantReviewStub()
            ->submitCustomerReview($merchantReviewRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RatingAggregationTransfer $ratingAggregationTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewSummaryTransfer
     */
    public function calculateMerchantReviewSummary(RatingAggregationTransfer $ratingAggregationTransfer): MerchantReviewSummaryTransfer
    {
        return $this->getFactory()
            ->createMerchantReviewSummaryCalculator()
            ->calculate($ratingAggregationTransfer);
    }
}
