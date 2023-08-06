<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Communication\Plugin\Publisher;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;
use SprykerDemo\Zed\MerchantReview\Dependency\MerchantReviewEvents;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Business\MerchantReviewSearchFacadeInterface getFacade()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchConfig getConfig()
 */
class MerchantReviewSearchWritePublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * Specification:
     *  - Writes merchant review search collection by merchant review events.
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $this->getFacade()->writeMerchantReviewSearchCollectionByMerchantReviewEvents($eventEntityTransfers);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<string>
     */
    public function getSubscribedEvents(): array
    {
        return [
            MerchantReviewEvents::ENTITY_SPY_MERCHANT_REVIEW_UPDATE,
            MerchantReviewEvents::MERCHANT_REVIEW_PUBLISH,
        ];
    }
}
