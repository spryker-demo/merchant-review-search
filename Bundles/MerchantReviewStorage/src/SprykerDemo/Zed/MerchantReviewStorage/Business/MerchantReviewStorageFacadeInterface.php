<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Business;

interface MerchantReviewStorageFacadeInterface
{
    /**
     * Specification:
     * - Gets merchantIds from eventTransfers.
     * - Queries all active merchant reviews with the given merchantIds.
     * - Stores data as json encoded to storage table.
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     *
     * @return void
     */
    public function writeCollectionByMerchantReviewEvents(array $eventTransfers): void;
}
