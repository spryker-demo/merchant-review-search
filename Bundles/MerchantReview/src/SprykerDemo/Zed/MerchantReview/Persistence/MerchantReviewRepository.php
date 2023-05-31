<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Persistence;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewPersistenceFactory getFactory()
 */
class MerchantReviewRepository extends AbstractRepository implements MerchantReviewRepositoryInterface
{
    /**
     * @param int $idMerchantReview
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer|null
     */
    public function findMerchantReviewById(int $idMerchantReview): ?MerchantReviewTransfer
    {
        $merchantReviewQuery = $this->getFactory()
            ->createMerchantReviewQuery()
            ->filterByIdMerchantReview($idMerchantReview);

        $merchantReviewEntityTransfer = $this->buildQueryFromCriteria($merchantReviewQuery)
            ->findOne();

        if (!$merchantReviewEntityTransfer) {
            return null;
        }

        return $this->getFactory()
            ->createMerchantReviewMapper()
            ->mapMerchantReviewEntityTransferToMerchantReviewTransfer($merchantReviewEntityTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function getMerchantReviews(): MerchantReviewCollectionTransfer
    {
        $merchantReviewEntities = $this->getFactory()
            ->createMerchantReviewQuery()
            ->find();

        return $this->getFactory()
            ->createMerchantReviewMapper()
            ->mapMerchantReviewEntitiesToMerchantReviewCollection($merchantReviewEntities);
    }

    /**
     * @param array $merchantReviewIds
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function getMerchantReviewsByIds(array $merchantReviewIds): MerchantReviewCollectionTransfer
    {
        $merchantReviewEntities = $this->getFactory()
            ->createMerchantReviewQuery()
            ->filterByIdMerchantReview_In($merchantReviewIds)
            ->find();

        return $this->getFactory()
            ->createMerchantReviewMapper()
            ->mapMerchantReviewEntitiesToMerchantReviewCollection($merchantReviewEntities);
    }
}
