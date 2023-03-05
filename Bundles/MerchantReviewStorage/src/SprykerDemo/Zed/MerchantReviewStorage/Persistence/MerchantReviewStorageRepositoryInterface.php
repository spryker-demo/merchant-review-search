<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Persistence;

use Generated\Shared\Transfer\MerchantReviewStorageCollectionTransfer;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStoragePersistenceFactory getFactory()
 */
interface MerchantReviewStorageRepositoryInterface
{
    /**
     * @param array $merchantIds
     *
     * @return \Generated\Shared\Transfer\MerchantReviewStorageCollectionTransfer|null
     */
    public function getMerchantReviewStorageByIds(array $merchantIds): ?MerchantReviewStorageCollectionTransfer;

    /**
     * @param array $merchantIds
     *
     * @return array|null
     */
    public function getMerchantReviewsByIdMerchants(array $merchantIds): ?array;

    /**
     * @param array $merchantReviewsIds
     *
     * @return array|null
     */
    public function getMerchantReviewsByIds(array $merchantReviewsIds): ?array;
}
