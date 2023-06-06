<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewStorage;

use Generated\Shared\Transfer\MerchantReviewStorageCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewStorageTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerDemo\Client\MerchantReviewStorage\MerchantReviewStorageFactory getFactory()
 */
class MerchantReviewStorageClient extends AbstractClient implements MerchantReviewStorageClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idMerchant
     *
     * @return \Generated\Shared\Transfer\MerchantReviewStorageTransfer|null
     */
    public function findMerchantReview(int $idMerchant): ?MerchantReviewStorageTransfer
    {
        return $this->getFactory()
            ->createMerchantReviewStorageReader()
            ->findMerchantReview($idMerchant);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MerchantReviewStorageCollectionTransfer
     */
    public function findMerchantReviews(): MerchantReviewStorageCollectionTransfer
    {
        return $this->getFactory()
            ->createMerchantReviewStorageReader()
            ->findMerchantReviews();
    }
}
