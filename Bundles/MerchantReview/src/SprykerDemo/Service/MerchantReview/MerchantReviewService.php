<?php

namespace SprykerDemo\Service\MerchantReview;

use Generated\Shared\Transfer\MerchantReviewSummaryTransfer;
use Generated\Shared\Transfer\RatingAggregationTransfer;
use Spryker\Service\Kernel\AbstractService;

/**
 * @method \SprykerDemo\Service\MerchantReview\MerchantReviewServiceFactory getFactory()
 */
class MerchantReviewService extends AbstractService implements MerchantReviewServiceInterface
{
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
