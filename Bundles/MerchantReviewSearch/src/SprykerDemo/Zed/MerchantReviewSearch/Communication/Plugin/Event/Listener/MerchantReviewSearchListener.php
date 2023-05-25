<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Communication\Plugin\Event\Listener;

use Orm\Zed\MerchantReview\Persistence\Map\SpyMerchantReviewTableMap;
use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchQueryContainerInterface getQueryContainer()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Communication\MerchantReviewSearchCommunicationFactory getFactory()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Business\MerchantReviewSearchFacadeInterface getFacade()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchConfig getConfig()
 */
class MerchantReviewSearchListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $merchantReviewIds = $this->getFactory()->getEventBehaviorFacade()->getEventTransferIds($eventEntityTransfers);
        $merchantIds = $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferForeignKeys($eventEntityTransfers, SpyMerchantReviewTableMap::COL_FK_MERCHANT);

        $this->getFacade()->publish($merchantReviewIds);

//        if ($merchantIds) {
//            $this->getFactory()->getMerchantSearchFacade()->refresh($merchantIds, [MerchantReviewSearchConfig::PLUGIN_MERCHANT_PAGE_RATING_DATA]);
//        }
    }
}
