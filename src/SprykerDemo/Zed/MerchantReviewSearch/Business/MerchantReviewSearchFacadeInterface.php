<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Business;

interface MerchantReviewSearchFacadeInterface
{
    /**
     * Specification:
     * - Writes merchant review search collection by merchant review events.
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     *
     * @return void
     */
    public function writeMerchantReviewSearchCollectionByMerchantReviewEvents(array $eventTransfers): void;

    /**
     * Specification:
     * - Deletes merchant review search collection by merchant review events.
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     *
     * @return void
     */
    public function deleteCollectionByMerchantReviewEvents(array $eventTransfers): void;
}
