<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Business\Storage;

use Generated\Shared\Transfer\MerchantReviewStorageTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewRepositoryInterface;
use SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageEntityManager;

class MerchantReviewStorageWriter implements MerchantReviewStorageWriterInterface
{
    /**
     * @param \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface $eventBehaviorFacade
     * @param \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewRepositoryInterface $merchantReviewRepository
     * @param \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageEntityManager $merchantReviewStorageEntityManager
     */
    public function __construct(
        protected EventBehaviorFacadeInterface $eventBehaviorFacade,
        protected MerchantReviewRepositoryInterface $merchantReviewRepository,
        protected MerchantReviewStorageEntityManager $merchantReviewStorageEntityManager
    ) {
    }

    /**
     * @param array $eventTransfers
     *
     * @return void
     */
    public function writeCollectionByMerchantReviewEvents(array $eventTransfers): void
    {
        $merchantReviewIds = $this->eventBehaviorFacade->getEventTransferIds($eventTransfers);

        if (!$merchantReviewIds) {
            return;
        }

        $this->writeCollectionByMerchantReviewIds($merchantReviewIds);
    }

    /**
     * @param array $merchantReviewIds
     *
     * @return void
     */
    protected function writeCollectionByMerchantReviewIds(array $merchantReviewIds): void
    {
        $merchantReviewCollectionTransfer = $this->merchantReviewRepository->getMerchantReviewsByIds(
            $merchantReviewIds,
        );

        foreach ($merchantReviewCollectionTransfer->getReviews() as $merchantReview) {
            $this->merchantReviewStorageEntityManager->saveMerchantReviewStorage(
                $this->mapMerchantReviewTransferToStorageTransfer($merchantReview, new MerchantReviewStorageTransfer()),
            );
        }
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReview
     * @param \Generated\Shared\Transfer\MerchantReviewStorageTransfer $merchantReviewStorageTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewStorageTransfer
     */
    protected function mapMerchantReviewTransferToStorageTransfer(
        MerchantReviewTransfer $merchantReview,
        MerchantReviewStorageTransfer $merchantReviewStorageTransfer
    ): MerchantReviewStorageTransfer {
        $merchantReviewStorageTransfer->fromArray($merchantReview->toArray(), true);

        return $merchantReviewStorageTransfer;
    }
}
