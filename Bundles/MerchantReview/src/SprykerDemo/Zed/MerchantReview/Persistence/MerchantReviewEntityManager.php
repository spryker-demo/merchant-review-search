<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Persistence;

use Generated\Shared\Transfer\MerchantReviewTransfer;
use Orm\Zed\MerchantReview\Persistence\Map\SpyMerchantReviewTableMap;
use Orm\Zed\MerchantReview\Persistence\SpyMerchantReview;
use Propel\Runtime\Exception\EntityNotFoundException;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewPersistenceFactory getFactory()
 */
class MerchantReviewEntityManager extends AbstractEntityManager implements MerchantReviewEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function createMerchantReview(MerchantReviewTransfer $merchantReviewTransfer): MerchantReviewTransfer
    {
        $merchantReviewEntity = $this->getFactory()
            ->createMerchantReviewMapper()
            ->mapMerchantReviewTransferToMerchantReviewEntity($merchantReviewTransfer, new SpyMerchantReview());
        $merchantReviewEntity->setStatus(SpyMerchantReviewTableMap::COL_STATUS_PENDING);
        $merchantReviewEntity->save();

        return $this->getFactory()
            ->createMerchantReviewMapper()
            ->mapMerchantReviewEntityToMerchantReviewTransfer($merchantReviewEntity, $merchantReviewTransfer);
    }

    /**
     * @param int $idMerchantReview
     *
     * @return void
     */
    public function deleteMerchantReview(int $idMerchantReview): void
    {
        $this->getFactory()
            ->createMerchantReviewQuery()
            ->filterByIdMerchantReview($idMerchantReview)
            ->findOne()
            ->delete();
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @throws \Propel\Runtime\Exception\EntityNotFoundException
     *
     * @return void
     */
    public function updateMerchantReview(MerchantReviewTransfer $merchantReviewTransfer): void
    {
        $merchantReviewEntity = $this->getFactory()
            ->createMerchantReviewQuery()
            ->filterByIdMerchantReview($merchantReviewTransfer->getIdMerchantReview())
            ->findOne();

        if ($merchantReviewEntity === null) {
            throw new EntityNotFoundException('Merchant review entity not found');
        }

        $this->getFactory()
            ->createMerchantReviewMapper()
            ->mapMerchantReviewTransferToMerchantReviewEntity($merchantReviewTransfer, $merchantReviewEntity);
        $merchantReviewEntity->save();
    }
}
