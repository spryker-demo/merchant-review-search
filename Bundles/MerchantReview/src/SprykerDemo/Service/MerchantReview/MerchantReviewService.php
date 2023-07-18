<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

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
