<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Business\Storage;

use Generated\Shared\Transfer\MerchantReviewStorageTransfer;
use Orm\Zed\MerchantReviewStorage\Persistence\SpyMerchantReviewStorage;
use SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageQueryContainerInterface;

class MerchantReviewStorageWriter implements MerchantReviewStorageWriterInterface
{
    /**
     * @var \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @deprecated Use {@link \Spryker\Zed\SynchronizationBehavior\SynchronizationBehaviorConfig::isSynchronizationEnabled()} instead.
     *
     * @var bool
     */
    protected $isSendingToQueue = true;

    /**
     * @param \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageQueryContainerInterface $queryContainer
     * @param bool $isSendingToQueue
     */
    public function __construct(
        MerchantReviewStorageQueryContainerInterface $queryContainer,
        bool $isSendingToQueue
    ) {
        $this->queryContainer = $queryContainer;
        $this->isSendingToQueue = $isSendingToQueue;
    }

    /**
     * @param array<int> $merchantIds
     *
     * @return void
     */
    public function publish(array $merchantIds): void
    {
        $merchantReviewEntities = $this->queryContainer->queryMerchantReviewsByIdMerchants($merchantIds)->find()->toArray();
        $merchantReviewStorageEntities = $this->findMerchantReviewStorageEntitiesByMerchantIds($merchantIds);

        if (!$merchantReviewEntities) {
            $this->deleteStorageData($merchantReviewStorageEntities);
        }

        $this->storeData($merchantReviewEntities, $merchantReviewStorageEntities);
    }

    /**
     * @param array<int> $merchantIds
     *
     * @return void
     */
    public function unpublish(array $merchantIds): void
    {
        $merchantReviewStorageEntities = $this->findMerchantReviewStorageEntitiesByMerchantIds($merchantIds);
        foreach ($merchantReviewStorageEntities as $merchantReviewStorageEntity) {
            $merchantReviewStorageEntity->delete();
        }
    }

    /**
     * @param array $merchantReviewStorageEntities
     *
     * @return void
     */
    protected function deleteStorageData(array $merchantReviewStorageEntities): void
    {
        foreach ($merchantReviewStorageEntities as $merchantReviewStorageEntity) {
            $merchantReviewStorageEntity->delete();
        }
    }

    /**
     * @param array $merchantReviewEntities
     * @param array $spyMerchantReviewStorageEntities
     *
     * @return void
     */
    protected function storeData(array $merchantReviewEntities, array $spyMerchantReviewStorageEntities): void
    {
        foreach ($merchantReviewEntities as $merchantReviewEntity) {
            $idMerchant = $merchantReviewEntity['idMerchant'];
            if (isset($spyMerchantReviewStorageEntities[$idMerchant])) {
                $this->storeDataSet($merchantReviewEntity, $spyMerchantReviewStorageEntities[$idMerchant]);

                continue;
            }

            $this->storeDataSet($merchantReviewEntity);
        }
    }

    /**
     * @param array $merchantReview
     * @param \Orm\Zed\MerchantReviewStorage\Persistence\SpyMerchantReviewStorage|null $spyMerchantReviewStorageEntity
     *
     * @return void
     */
    protected function storeDataSet(array $merchantReview, ?SpyMerchantReviewStorage $spyMerchantReviewStorageEntity = null): void
    {
        if ($spyMerchantReviewStorageEntity === null) {
            $spyMerchantReviewStorageEntity = new SpyMerchantReviewStorage();
        }

        $merchantReviewStorageTransfer = (new MerchantReviewStorageTransfer())->fromArray($merchantReview);
        $merchantReviewStorageTransfer->setAverageRating(round($merchantReviewStorageTransfer->getAverageRating(), 1));
        $spyMerchantReviewStorageEntity->setFkMerchant($merchantReview['idMerchant']);
        $spyMerchantReviewStorageEntity->setData($merchantReviewStorageTransfer->modifiedToArray());
        $spyMerchantReviewStorageEntity->setIsSendingToQueue($this->isSendingToQueue);
        $spyMerchantReviewStorageEntity->save();
    }

    /**
     * @param array<int> $merchantIds
     *
     * @return array
     */
    protected function findMerchantReviewStorageEntitiesByMerchantIds(array $merchantIds): array
    {
        $merchantReviewStorageEntities = $this->queryContainer->queryMerchantReviewStorageByIds($merchantIds)->find();
        $merchantStorageReviewEntitiesById = [];
        foreach ($merchantReviewStorageEntities as $merchantReviewStorageEntity) {
            $merchantStorageReviewEntitiesById[$merchantReviewStorageEntity->getFkMerchant()] = $merchantReviewStorageEntity;
        }

        return $merchantStorageReviewEntitiesById;
    }
}
