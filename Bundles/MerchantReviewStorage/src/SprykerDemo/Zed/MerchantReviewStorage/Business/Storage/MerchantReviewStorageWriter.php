<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Business\Storage;

use Generated\Shared\Transfer\MerchantReviewStorageTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use SprykerDemo\Zed\MerchantReview\Business\MerchantReviewFacadeInterface;
use SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageEntityManagerInterface;

class MerchantReviewStorageWriter implements MerchantReviewStorageWriterInterface
{
    /**
     * @var \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected EventBehaviorFacadeInterface $eventBehaviorFacade;

    /**
     * @var \SprykerDemo\Zed\MerchantReview\Business\MerchantReviewFacadeInterface
     */
    protected MerchantReviewFacadeInterface $merchantReviewFacade;

    /**
     * @var \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageEntityManagerInterface
     */
    protected MerchantReviewStorageEntityManagerInterface $merchantReviewStorageEntityManager;

    /**
     * @param \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface $eventBehaviorFacade
     * @param \SprykerDemo\Zed\MerchantReview\Business\MerchantReviewFacadeInterface $merchantReviewFacade
     * @param \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageEntityManagerInterface $merchantReviewStorageEntityManager
     */
    public function __construct(
        EventBehaviorFacadeInterface $eventBehaviorFacade,
        MerchantReviewFacadeInterface $merchantReviewFacade,
        MerchantReviewStorageEntityManagerInterface $merchantReviewStorageEntityManager
    ) {
        $this->merchantReviewStorageEntityManager = $merchantReviewStorageEntityManager;
        $this->merchantReviewFacade = $merchantReviewFacade;
        $this->eventBehaviorFacade = $eventBehaviorFacade;
    }

    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
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
     * @param array<int> $merchantReviewIds
     *
     * @return void
     */
    protected function writeCollectionByMerchantReviewIds(array $merchantReviewIds): void
    {
        $merchantReviewCollectionTransfer = $this->merchantReviewFacade->getMerchantReviewsByIds(
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
        $merchantReviews = $merchantReviewStorageTransfer->getReviews();
        $merchantReviews[] = $merchantReview->toArray();

        $merchantReviewStorageTransfer->setIdMerchant($merchantReview->getFkMerchant());
        $merchantReviewStorageTransfer->setReviews($merchantReviews);

        return $merchantReviewStorageTransfer;
    }
}
