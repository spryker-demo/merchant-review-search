<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewSearch\Reader;

use Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer;
use Generated\Shared\Transfer\RatingAggregationTransfer;

interface MerchantRatingAggregationReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RatingAggregationTransfer
     */
    public function get(MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer): RatingAggregationTransfer;
}
