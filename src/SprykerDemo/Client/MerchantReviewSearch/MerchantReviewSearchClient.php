<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewSearch;

use Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer;
use Generated\Shared\Transfer\RatingAggregationTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerDemo\Client\MerchantReviewSearch\MerchantReviewSearchFactory getFactory()
 */
class MerchantReviewSearchClient extends AbstractClient implements MerchantReviewSearchClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer
     *
     * @return array<string, mixed>
     */
    public function search(MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer): array
    {
        return $this->getFactory()
            ->createMerchantReviewSearchReader($merchantReviewSearchRequestTransfer)
            ->search($merchantReviewSearchRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RatingAggregationTransfer
     */
    public function getMerchantRatingAggregation(MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer): RatingAggregationTransfer
    {
        return $this->getFactory()
            ->createMerchantRatingAggregationReader($merchantReviewSearchRequestTransfer)
            ->get($merchantReviewSearchRequestTransfer);
    }
}
