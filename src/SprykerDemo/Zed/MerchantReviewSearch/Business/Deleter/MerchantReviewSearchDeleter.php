<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Business\Deleter;

use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchEntityManagerInterface;

class MerchantReviewSearchDeleter implements MerchantReviewSearchDeleterInterface
{
    /**
     * @var \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchEntityManagerInterface
     */
    protected MerchantReviewSearchEntityManagerInterface $merchantReviewSearchEntityManager;

    /**
     * @var \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected EventBehaviorFacadeInterface $eventBehaviorFacade;

    /**
     * @param \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchEntityManagerInterface $merchantReviewSearchEntityManager
     * @param \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface $eventBehaviorFacade
     */
    public function __construct(
        MerchantReviewSearchEntityManagerInterface $merchantReviewSearchEntityManager,
        EventBehaviorFacadeInterface $eventBehaviorFacade
    ) {
        $this->merchantReviewSearchEntityManager = $merchantReviewSearchEntityManager;
        $this->eventBehaviorFacade = $eventBehaviorFacade;
    }

    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     *
     * @return void
     */
    public function deleteCollectionByMerchantReviewEvents(array $eventTransfers): void
    {
        $merchantReviewIds = $this->eventBehaviorFacade->getEventTransferIds($eventTransfers);

        if (!$merchantReviewIds) {
            return;
        }

        $this->merchantReviewSearchEntityManager->deleteMerchantReviewSearchByMerchantReviewIds($merchantReviewIds);
    }
}
