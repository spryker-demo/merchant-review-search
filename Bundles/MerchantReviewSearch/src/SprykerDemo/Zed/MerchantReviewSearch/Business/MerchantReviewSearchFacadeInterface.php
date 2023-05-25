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
     * - Queries all merchantReview with merchantReviewIds
     * - Stores data as json encoded to storage table
     * - Sends a copy of data to queue based on module config
     *
     * @api
     *
     * @param array $merchantReviewIds
     *
     * @return void
     */
    public function publish(array $merchantReviewIds): void;

    /**
     * Specification:
     * - Finds and deletes merchantReview storage entities with merchantReviewIds
     * - Sends delete message to queue based on module config
     *
     * @api
     *
     * @param array $merchantReviewIds
     *
     * @return void
     */
    public function unpublish(array $merchantReviewIds): void;
}
