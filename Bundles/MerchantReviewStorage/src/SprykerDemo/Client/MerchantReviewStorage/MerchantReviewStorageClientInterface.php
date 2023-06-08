<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewStorage;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewStorageTransfer;

/**
 * @method \SprykerDemo\Client\MerchantReviewStorage\MerchantReviewStorageFactory getFactory()
 */
interface MerchantReviewStorageClientInterface
{
    /**
     * Specification:
     *  - Returns all merchant reviews from storage.
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function findMerchantReviews(int $idMerchant): MerchantReviewCollectionTransfer;
}
