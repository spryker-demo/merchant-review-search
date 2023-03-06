<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Persistence;

use Generated\Shared\Transfer\MerchantReviewStorageCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewStorageTransfer;
use Orm\Zed\MerchantReview\Persistence\Map\SpyMerchantReviewTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStoragePersistenceFactory getFactory()
 */
class MerchantReviewStorageRepository extends AbstractRepository implements MerchantReviewStorageRepositoryInterface
{

    public const FIELD_FK_MERCHANT = MerchantReviewStorageTransfer::ID_MERCHANT;

    public const FIELD_AVERAGE_RATING = MerchantReviewStorageTransfer::AVERAGE_RATING;

    public const FIELD_COUNT = MerchantReviewStorageTransfer::REVIEW_COUNT;

    /**
     * @param array $merchantIds
     *
     * @return \Generated\Shared\Transfer\MerchantReviewStorageCollectionTransfer|null
     */
    public function getMerchantReviewStorageByIds(array $merchantIds): ?MerchantReviewStorageCollectionTransfer
    {
        $merchantReviewStorageEntities = $this->getFactory()
            ->createMerchantReviewStorageQuery()
            ->filterByFkMerchant_In($merchantIds)
            ->find();

        if (!$merchantReviewStorageEntities) {
            return null;
        }

        return $this->getFactory()
            ->createMerchantReviewStorageMapper()
            ->mapMerchantReviewStorageEntitiesToMerchantReviewStorageCollectionTransfer($merchantReviewStorageEntities);
    }

    /**
     * @param array $merchantIds
     *
     * @return array|null
     */
    public function getMerchantReviewsByIdMerchants(array $merchantIds): ?array
    {
        $spyMerchantReviewQuery = $this->getFactory()
            ->getMerchantReviewFacade()
            ->queryMerchantReview()
            ->filterByFkMerchant_In($merchantIds)
            ->filterByStatus(SpyMerchantReviewTableMap::COL_STATUS_APPROVED)
            ->withColumn(SpyMerchantReviewTableMap::COL_FK_MERCHANT, static::FIELD_FK_MERCHANT)
            ->withColumn(sprintf('AVG(%s)', SpyMerchantReviewTableMap::COL_RATING), static::FIELD_AVERAGE_RATING)
            ->withColumn(sprintf('COUNT(%s)', SpyMerchantReviewTableMap::COL_FK_MERCHANT), static::FIELD_COUNT)
            ->select(
                [
                    static::FIELD_FK_MERCHANT,
                    static::FIELD_AVERAGE_RATING,
                    static::FIELD_COUNT,
                ],
            )
            ->groupBy(SpyMerchantReviewTableMap::COL_FK_MERCHANT);

        return $spyMerchantReviewQuery?->find()
            ->toArray();
    }

    public function getMerchantReviewsByIds(array $merchantReviewsIds): ?array
    {
        // TODO: Implement getMerchantReviewsByIds() method.
    }
}
