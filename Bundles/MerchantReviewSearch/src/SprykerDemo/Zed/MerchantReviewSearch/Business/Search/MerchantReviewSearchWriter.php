<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Business\Search;

use Generated\Shared\Search\MerchantReviewIndexMap;
use Generated\Shared\Transfer\MerchantReviewSearchTransfer;
use Orm\Zed\MerchantReview\Persistence\Map\SpyMerchantReviewTableMap;
use Orm\Zed\MerchantReview\Persistence\SpyMerchantReview;
use Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearch;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchQueryContainerInterface;

class MerchantReviewSearchWriter implements MerchantReviewSearchWriterInterface
{
    /**
     * @var \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @deprecated Use {@link \Spryker\Zed\SynchronizationBehavior\SynchronizationBehaviorConfig::isSynchronizationEnabled()} instead.
     *
     * @var bool
     */
    protected $isSendingToQueue = true;

    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @param \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchQueryContainerInterface $queryContainer
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     * @param bool $isSendingToQueue
     */
    public function __construct(
        MerchantReviewSearchQueryContainerInterface $queryContainer,
        UtilEncodingServiceInterface $utilEncodingService,
        StoreFacadeInterface $storeFacade,
        $isSendingToQueue
    ) {
        $this->queryContainer = $queryContainer;
        $this->utilEncodingService = $utilEncodingService;
        $this->storeFacade = $storeFacade;
        $this->isSendingToQueue = $isSendingToQueue;
    }

    /**
     * @param array $merchantReviewIds
     *
     * @return void
     */
    public function publish(array $merchantReviewIds): void
    {
        $merchantReviewEntities = $this->queryContainer->queryMerchantReviewsByIdMerchantReviews($merchantReviewIds)->find()->getData();
        $merchantReviewSearchEntitiesByMerchantReviewIds = $this->findMerchantReviewSearchEntitiesByMerchantReviewIds($merchantReviewIds);

        if (!$merchantReviewEntities) {
            $this->deleteSearchData($merchantReviewSearchEntitiesByMerchantReviewIds);
        }

        $this->storeData($merchantReviewEntities, $merchantReviewSearchEntitiesByMerchantReviewIds);
    }

    /**
     * @param array $merchantReviewIds
     *
     * @return void
     */
    public function unpublish(array $merchantReviewIds): void
    {
        $merchantReviewSearchEntities = $this->findMerchantReviewSearchEntitiesByMerchantReviewIds($merchantReviewIds);
        foreach ($merchantReviewSearchEntities as $merchantReviewSearchEntity) {
            $merchantReviewSearchEntity->delete();
        }
    }

    /**
     * @param array<\Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearch> $merchantReviewSearchEntities
     *
     * @return void
     */
    protected function deleteSearchData(array $merchantReviewSearchEntities): void
    {
        foreach ($merchantReviewSearchEntities as $merchantReviewSearchEntity) {
            $merchantReviewSearchEntity->delete();
        }
    }

    /**
     * @param array<\Orm\Zed\MerchantReview\Persistence\SpyMerchantReview> $merchantReviewEntities
     * @param array $spyMerchantReviewSearchEntities
     *
     * @return void
     */
    protected function storeData(array $merchantReviewEntities, array $spyMerchantReviewSearchEntities): void
    {
        foreach ($merchantReviewEntities as $merchantReviewEntity) {
            $idMerchantReview = $merchantReviewEntity->getIdMerchantReview();
            if (isset($spyMerchantReviewSearchEntities[$idMerchantReview])) {
                $this->storeDataSet($merchantReviewEntity, $spyMerchantReviewSearchEntities[$idMerchantReview]);

                continue;
            }

            $this->storeDataSet($merchantReviewEntity, null);
        }
    }

    /**
     * @param \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview $merchantReviewEntity
     * @param \Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearch|null $spyMerchantReviewSearchEntity
     *
     * @return void
     */
    protected function storeDataSet(SpyMerchantReview $merchantReviewEntity, ?SpyMerchantReviewSearch $spyMerchantReviewSearchEntity = null): void
    {
        if ($spyMerchantReviewSearchEntity === null) {
            $spyMerchantReviewSearchEntity = new SpyMerchantReviewSearch();
        }

        if ($merchantReviewEntity->getStatus() !== SpyMerchantReviewTableMap::COL_STATUS_APPROVED) {
            if (!$spyMerchantReviewSearchEntity->isNew()) {
                $spyMerchantReviewSearchEntity->delete();
            }

            return;
        }

        $result = $this->mapToSearchData($merchantReviewEntity);

        $spyMerchantReviewSearchEntity->setFkMerchantReview($merchantReviewEntity->getIdMerchantReview());
        $spyMerchantReviewSearchEntity->setData($result);
        $spyMerchantReviewSearchEntity->setStructuredData($this->utilEncodingService->encodeJson($merchantReviewEntity->toArray()));
        $spyMerchantReviewSearchEntity->setIsSendingToQueue($this->isSendingToQueue);
        $spyMerchantReviewSearchEntity->save();
    }

    /**
     * @param \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview $merchantReviewEntity
     *
     * @return array
     */
    protected function mapToSearchData(SpyMerchantReview $merchantReviewEntity): array
    {
        return [
            MerchantReviewIndexMap::STORE => $this->storeFacade->getCurrentStore(),
            MerchantReviewIndexMap::ID_MERCHANT => $merchantReviewEntity->getFkMerchant(),
            MerchantReviewIndexMap::RATING => $merchantReviewEntity->getRating(),
            MerchantReviewIndexMap::SEARCH_RESULT_DATA => $this->getSearchResultData($merchantReviewEntity),
            MerchantReviewIndexMap::CREATED_AT => $merchantReviewEntity->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * @param array $merchantReviewIds
     *
     * @return array
     */
    protected function findMerchantReviewSearchEntitiesByMerchantReviewIds(array $merchantReviewIds): array
    {
        $merchantReviewSearchEntities = $this->queryContainer->queryMerchantReviewSearchByIds($merchantReviewIds)->find();
        $merchantReviewSearchReviewEntitiesById = [];
        foreach ($merchantReviewSearchEntities as $merchantReviewReviewSearchEntity) {
            $merchantReviewSearchReviewEntitiesById[$merchantReviewReviewSearchEntity->getFkMerchantReview()] = $merchantReviewReviewSearchEntity;
        }

        return $merchantReviewSearchReviewEntitiesById;
    }

    /**
     * @param \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview $spyMerchantReview
     *
     * @return array
     */
    protected function getSearchResultData(SpyMerchantReview $spyMerchantReview): array
    {
        $merchantReviewTransfer = new MerchantReviewSearchTransfer();
        $merchantReviewTransfer->fromArray($spyMerchantReview->toArray(), true);

        return $merchantReviewTransfer->modifiedToArray();
    }
}
