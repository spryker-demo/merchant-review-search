<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewStorage;

use Generated\Shared\Transfer\MerchantReviewStorageTransfer;

/**
 * @method \SprykerDemo\Client\MerchantReviewStorage\MerchantReviewStorageFactory getFactory()
 */
interface MerchantReviewStorageClientInterface
{
    /**
     * Specification:
     *  - Return merchant review storage data by merchant id.
     *
     * @api
     *
     * @param int $idMerchant
     *
     * @return \Generated\Shared\Transfer\MerchantReviewStorageTransfer|null
     */
    public function findMerchantReview(int $idMerchant): ?MerchantReviewStorageTransfer;
}
