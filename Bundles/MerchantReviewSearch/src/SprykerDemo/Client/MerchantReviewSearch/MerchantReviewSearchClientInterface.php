<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewSearch;

use Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer;

/**
 * @method \SprykerDemo\Client\MerchantReviewSearch\MerchantReviewSearchFactory getFactory()
 */
interface MerchantReviewSearchClientInterface
{
    /**
     * Specification:
     * - Makes ElasticSearch request.
     * - Returns the list of merchant reviews.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer
     *
     * @return \Elastica\ResultSet|mixed|array
     */
    public function search(MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer): mixed;
}
