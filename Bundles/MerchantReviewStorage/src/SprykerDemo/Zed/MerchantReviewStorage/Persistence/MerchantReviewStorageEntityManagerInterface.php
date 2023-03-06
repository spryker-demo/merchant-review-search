<?php

namespace SprykerDemo\Zed\MerchantReviewStorage\Persistence;

use Generated\Shared\Transfer\MerchantReviewStorageTransfer;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStoragePersistenceFactory getFactory()
 */
interface MerchantReviewStorageEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewStorageTransfer $merchantReviewStorageTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return \Generated\Shared\Transfer\MerchantReviewStorageTransfer
     */
    public function saveMerchantReviewStorage(MerchantReviewStorageTransfer $merchantReviewStorageTransfer
    ): MerchantReviewStorageTransfer;
}
