<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Business\MerchantReviewSearchBusinessFactory getFactory()
 */
class MerchantReviewSearchFacade extends AbstractFacade implements MerchantReviewSearchFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     *
     * @return void
     */
    public function writeMerchantReviewSearchCollectionByMerchantReviewEvents(array $eventTransfers): void
    {
        $this->getFactory()->createMerchantReviewSearchWriter()->writeMerchantReviewSearchCollectionByMerchantReviewEvents($eventTransfers);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     *
     * @return void
     */
    public function deleteCollectionByMerchantReviewEvents(array $eventTransfers): void
    {
        $this->getFactory()->createMerchantReviewSearchDeleter()->deleteCollectionByMerchantReviewEvents($eventTransfers);
    }
}
