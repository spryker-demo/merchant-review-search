<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Business\MerchantReviewStorageBusinessFactory getFactory()
 */
class MerchantReviewStorageFacade extends AbstractFacade implements MerchantReviewStorageFacadeInterface
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
    public function writeCollectionByMerchantReviewEvents(array $eventTransfers): void
    {
        $this->getFactory()
            ->createMerchantReviewStorageWriter()
            ->writeCollectionByMerchantReviewEvents($eventTransfers);
    }
}
