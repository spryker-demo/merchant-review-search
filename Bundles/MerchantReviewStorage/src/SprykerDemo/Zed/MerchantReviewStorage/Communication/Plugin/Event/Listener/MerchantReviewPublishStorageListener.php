<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Communication\Plugin\Event\Listener;

use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageQueryContainerInterface getQueryContainer()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Communication\MerchantReviewStorageCommunicationFactory getFactory()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Business\MerchantReviewStorageFacadeInterface getFacade()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\MerchantReviewStorageConfig getConfig()
 */
class MerchantReviewPublishStorageListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName)
    {
        $merchantIds = $this->getFactory()->getEventBehaviorFacade()->getEventTransferIds($eventEntityTransfers);

        $this->getFacade()->publish($merchantIds);
    }
}
