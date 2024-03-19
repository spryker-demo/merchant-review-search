<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Business\Writer;

use Generated\Shared\Search\MerchantReviewIndexMap;
use Generated\Shared\Transfer\MerchantReviewCriteriaTransfer;
use Generated\Shared\Transfer\MerchantReviewSearchTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Orm\Zed\MerchantReview\Persistence\Map\SpyMerchantReviewTableMap;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use SprykerDemo\Zed\MerchantReview\Business\MerchantReviewFacadeInterface;
use SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchEntityManagerInterface;
use SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchRepositoryInterface;

class MerchantReviewSearchWriter implements MerchantReviewSearchWriterInterface
{
    /**
     * @var \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchEntityManagerInterface
     */
    protected MerchantReviewSearchEntityManagerInterface $merchantReviewSearchEntityManager;

    /**
     * @var \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchRepositoryInterface
     */
    protected MerchantReviewSearchRepositoryInterface $merchantReviewSearchRepository;

    /**
     * @var \SprykerDemo\Zed\MerchantReview\Business\MerchantReviewFacadeInterface
     */
    protected MerchantReviewFacadeInterface $merchantReviewFacade;

    /**
     * @var \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected EventBehaviorFacadeInterface $eventBehaviorFacade;

    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected StoreFacadeInterface $storeFacade;

    /**
     * @var \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected UtilEncodingServiceInterface $utilEncodingService;

    /**
     * @var \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected LocaleFacadeInterface $localeFacade;

    /**
     * @param \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchEntityManagerInterface $merchantReviewSearchEntityManager
     * @param \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchRepositoryInterface $merchantReviewSearchRepository
     * @param \SprykerDemo\Zed\MerchantReview\Business\MerchantReviewFacadeInterface $merchantReviewFacade
     * @param \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface $eventBehaviorFacade
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     * @param \Spryker\Zed\Locale\Business\LocaleFacadeInterface $localeFacade
     */
    public function __construct(
        MerchantReviewSearchEntityManagerInterface $merchantReviewSearchEntityManager,
        MerchantReviewSearchRepositoryInterface $merchantReviewSearchRepository,
        MerchantReviewFacadeInterface $merchantReviewFacade,
        EventBehaviorFacadeInterface $eventBehaviorFacade,
        StoreFacadeInterface $storeFacade,
        UtilEncodingServiceInterface $utilEncodingService,
        LocaleFacadeInterface $localeFacade
    ) {
        $this->merchantReviewSearchEntityManager = $merchantReviewSearchEntityManager;
        $this->merchantReviewSearchRepository = $merchantReviewSearchRepository;
        $this->merchantReviewFacade = $merchantReviewFacade;
        $this->eventBehaviorFacade = $eventBehaviorFacade;
        $this->storeFacade = $storeFacade;
        $this->utilEncodingService = $utilEncodingService;
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     *
     * @return void
     */
    public function writeMerchantReviewSearchCollectionByMerchantReviewEvents(array $eventTransfers): void
    {
        $merchantReviewIds = $this->eventBehaviorFacade->getEventTransferIds($eventTransfers);
        if (!$merchantReviewIds) {
            return;
        }

        $merchantReviewCollectionTransfer = $this->merchantReviewFacade->getMerchantReviews((new MerchantReviewCriteriaTransfer())->setMerchantReviewIds($merchantReviewIds));

        if (!$merchantReviewCollectionTransfer->getMerchantReviews()->count()) {
            $this->merchantReviewSearchEntityManager->deleteMerchantReviewSearchByMerchantReviewIds($merchantReviewIds);

            return;
        }

        $merchantReviewSearchTransfersIndexedByMerchantReviewId = $this->merchantReviewSearchRepository->getMerchantReviewSearchTransfersIndexedByMerchantReviewId($merchantReviewIds);

        $this->processMerchantReviewSearchEntities($merchantReviewCollectionTransfer->getMerchantReviews()->getArrayCopy(), $merchantReviewSearchTransfersIndexedByMerchantReviewId);
    }

    /**
     * @param array<\Generated\Shared\Transfer\MerchantReviewTransfer> $merchantReviews
     * @param array<\Generated\Shared\Transfer\MerchantReviewSearchTransfer> $merchantReviewSearchTransfersIndexedByMerchantReviewId
     *
     * @return void
     */
    protected function processMerchantReviewSearchEntities(array $merchantReviews, array $merchantReviewSearchTransfersIndexedByMerchantReviewId): void
    {
        $merchantReviewIdsToDelete = [];
        foreach ($merchantReviews as $merchantReview) {
            if ($merchantReview->getStatus() === SpyMerchantReviewTableMap::COL_STATUS_APPROVED) {
                $this->storeMerchantReviewSearch($merchantReview, $merchantReviewSearchTransfersIndexedByMerchantReviewId[$merchantReview->getIdMerchantReview()] ?? $this->createMerchantSearchTransfer($merchantReview));

                continue;
            }
            if ($merchantReview->getIdMerchantReview() !== null && isset($merchantReviewSearchTransfersIndexedByMerchantReviewId[$merchantReview->getIdMerchantReview()])) {
                $merchantReviewIdsToDelete[] = $merchantReview->getIdMerchantReview();
            }
        }

        if ($merchantReviewIdsToDelete) {
            $this->merchantReviewSearchEntityManager->deleteMerchantReviewSearchByMerchantReviewIds($merchantReviewIdsToDelete);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     * @param \Generated\Shared\Transfer\MerchantReviewSearchTransfer $merchantReviewSearchTransfer
     *
     * @return void
     */
    protected function storeMerchantReviewSearch(
        MerchantReviewTransfer $merchantReviewTransfer,
        MerchantReviewSearchTransfer $merchantReviewSearchTransfer
    ): void {
        $merchantReviewSearchTransfer->setData($this->mapToSearchData($merchantReviewTransfer))
                ->setStructuredData($this->utilEncodingService->encodeJson($merchantReviewTransfer->toArray()));

        $this->merchantReviewSearchEntityManager->saveMerchnatReviewSearch($merchantReviewSearchTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return array<string, mixed>
     */
    protected function mapToSearchData(MerchantReviewTransfer $merchantReviewTransfer): array
    {
        return [
            MerchantReviewIndexMap::STORE => $this->storeFacade->getCurrentStore(),
            MerchantReviewIndexMap::LOCALE => $this->localeFacade->getLocaleById($merchantReviewTransfer->getIdLocale())->getLocaleName(),
            MerchantReviewIndexMap::ID_MERCHANT => $merchantReviewTransfer->getFkMerchant(),
            MerchantReviewIndexMap::RATING => $merchantReviewTransfer->getRating(),
            MerchantReviewIndexMap::SEARCH_RESULT_DATA => $merchantReviewTransfer->toArray(),
            MerchantReviewIndexMap::CREATED_AT => $merchantReviewTransfer->getCreatedAt(),
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewSearchTransfer
     */
    protected function createMerchantSearchTransfer(MerchantReviewTransfer $merchantReviewTransfer): MerchantReviewSearchTransfer
    {
        return (new MerchantReviewSearchTransfer())
            ->setIdMerchnatReview($merchantReviewTransfer->getIdMerchantReview())
            ->setFkMerchant($merchantReviewTransfer->getFkMerchant());
    }
}
