<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewSearch\Reader;

use Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer;

interface MerchantReviewSearchReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer
     *
     * @return \Elastica\ResultSet|mixed|array
     */
    public function findMerchantReviews(MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer): mixed;

    /**
     * @return \Elastica\ResultSet|mixed|array
     */
    public function searchMerchantReviews();
}
