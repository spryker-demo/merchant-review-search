<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewSearch;

use Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer;
use Generated\Shared\Transfer\RatingAggregationTransfer;

interface MerchantReviewSearchClientInterface
{
    /**
     * Specification:
     *  - Search for merchant reviews.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer
     *
     * @return array<string, mixed>
     */
    public function search(MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer): array;

    /**
     * Specification:
     *  - Gets merchant rating aggregation.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RatingAggregationTransfer
     */
    public function getMerchantRatingAggregation(MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer): RatingAggregationTransfer;
}
