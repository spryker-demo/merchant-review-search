<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Persistence;

use Generated\Shared\Transfer\MerchantReviewStorageTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;
use SprykerDemo\Zed\MerchantReviewStorage\Communication\Exception\MerchantIncorrectDataException;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStoragePersistenceFactory getFactory()
 */
class MerchantReviewStorageEntityManager extends AbstractEntityManager implements MerchantReviewStorageEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewStorageTransfer $merchantReviewStorageTransfer
     *
     * @throws \SprykerDemo\Zed\MerchantReviewStorage\Communication\Exception\MerchantIncorrectDataException
     *
     * @return \Generated\Shared\Transfer\MerchantReviewStorageTransfer
     */
    public function saveMerchantReviewStorage(MerchantReviewStorageTransfer $merchantReviewStorageTransfer): MerchantReviewStorageTransfer
    {
        $idMerchant = $merchantReviewStorageTransfer->getIdMerchant();
        if (!$idMerchant) {
            throw new MerchantIncorrectDataException('Id merchant should be provider');
        }
        $merchantReviewStorageEntity = $this->getFactory()
            ->createMerchantReviewStorageQuery()
            ->filterByFkMerchant($idMerchant)
            ->findOneOrCreate();

        $merchantReviewStorageEntity->setData($merchantReviewStorageTransfer->toArray());
        $merchantReviewStorageEntity->setFkMerchant($idMerchant);
        $merchantReviewStorageEntity->save();

        return $this->getFactory()
            ->createMerchantReviewStorageMapper()
            ->mapMerchantReviewStorageEntityToMerchantReviewStorageTransfer(
                $merchantReviewStorageEntity,
            );
    }
}
