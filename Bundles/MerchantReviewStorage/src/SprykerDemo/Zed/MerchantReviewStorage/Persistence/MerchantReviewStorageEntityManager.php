<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Persistence;

use Generated\Shared\Transfer\MerchantReviewStorageTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStoragePersistenceFactory getFactory()
 */
class MerchantReviewStorageEntityManager extends AbstractEntityManager implements MerchantReviewStorageEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewStorageTransfer $merchantReviewStorageTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewStorageTransfer
     */
    public function saveMerchantReviewStorage(MerchantReviewStorageTransfer $merchantReviewStorageTransfer): MerchantReviewStorageTransfer
    {
        $merchantReviewStorageEntity = $this->getFactory()
            ->createMerchantReviewStorageQuery()
            ->filterByFkMerchant($merchantReviewStorageTransfer->getFkMerchant())
            ->findOneOrCreate();

        $merchantReviewStorageEntity->setData($merchantReviewStorageTransfer->toArray());
        $merchantReviewStorageEntity->setFkMerchant($merchantReviewStorageTransfer->getFkMerchant());
        $merchantReviewStorageEntity->save();

        return $this->getFactory()
            ->createMerchantReviewStorageMapper()
            ->mapMerchantReviewStorageEntityToMerchantReviewStorageTransfer(
                $merchantReviewStorageEntity,
            );
    }
}
