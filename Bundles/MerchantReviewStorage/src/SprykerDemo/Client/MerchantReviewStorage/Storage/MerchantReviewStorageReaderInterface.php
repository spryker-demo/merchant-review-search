<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewStorage\Storage;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewStorageTransfer;

interface MerchantReviewStorageReaderInterface
{
    /**
     * @param int $idMerchant
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function findMerchantReviews(int $idMerchant): MerchantReviewCollectionTransfer;
}
