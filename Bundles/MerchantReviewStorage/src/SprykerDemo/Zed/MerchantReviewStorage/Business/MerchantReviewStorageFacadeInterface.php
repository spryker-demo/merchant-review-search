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
     * - Queries all merchantReview with merchantIds
     * - Stores data as json encoded to storage table
     * - Sends a copy of data to queue based on module config
     *
     * @api
     *
     * @param array<int> $merchantIds
     *
     * @return void
     */
    public function publish(array $merchantIds): void;

    /**
     * Specification:
     * - Finds and deletes merchantReview storage entities with merchantIds
     * - Sends delete message to queue based on module config
     *
     * @api
     *
     * @param array<int> $merchantIds
     *
     * @return void
     */
    public function unpublish(array $merchantIds): void;
}
