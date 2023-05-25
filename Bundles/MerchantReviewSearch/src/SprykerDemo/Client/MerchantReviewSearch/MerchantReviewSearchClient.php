<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewSearch;

use Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer;
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
     * @return \Elastica\ResultSet|mixed|array
     */
    public function search(MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer): mixed
    {
        return $this->getFactory()
            ->createMerchantReviewSearchReader($merchantReviewSearchRequestTransfer)
            ->findMerchantReviews($merchantReviewSearchRequestTransfer);
    }
}
