<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewStorage\Storage;

use Generated\Shared\Transfer\MerchantReviewStorageCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewStorageTransfer;

interface MerchantReviewStorageReaderInterface
{
    /**
     * @param int $idMerchant
     *
     * @return \Generated\Shared\Transfer\MerchantReviewStorageTransfer|null
     */
    public function findMerchantReview(int $idMerchant): ?MerchantReviewStorageTransfer;

    /**
     * @return \Generated\Shared\Transfer\MerchantReviewStorageCollectionTransfer
     */
    public function findMerchantReviews(): MerchantReviewStorageCollectionTransfer;
}
