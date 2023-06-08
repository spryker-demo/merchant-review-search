<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;

interface MerchantReviewFacadeInterface
{
    /**
     * Specification:
     *    - Stores provided merchant review in persistent storage with pending status.
     *    - Checks if provided rating in transfer object does not exceed configured limit
     *    - Returns the provided transfer object updated with the stored entity's data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function createMerchantReview(
        MerchantReviewTransfer $merchantReviewTransfer
    ): MerchantReviewTransfer;

    /**
     * Specification:
     * - Retrieves the merchant review from persistent storage that matches the provided id in the transfer object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer|null
     */
    public function findOne(
        MerchantReviewTransfer $merchantReviewTransfer
    ): ?MerchantReviewTransfer;

    /**
     * Specification:
     * - Updates merchant review's status in persistent storage that matches the provided id in the transfer object.
     * - Returns the provided transfer object updated with the saved entity's data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function updateMerchantReviewStatus(
        MerchantReviewTransfer $merchantReviewTransfer
    ): MerchantReviewTransfer;

    /**
     * Specification:
     * - Permanently deletes the merchant review from persistent storage that matches the provided id in the transfer
     * object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return void
     */
    public function deleteMerchantReview(
        MerchantReviewTransfer $merchantReviewTransfer
    ): void;

    /**
     * Specification:
     * - Returns all available merchant reviews
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function getMerchantReviews(): MerchantReviewCollectionTransfer;

    /**
     * Specification:
     * - Returns all available merchant reviews by provided ids
     *
     * @api
     *
     * @param array $merchantReviewIds
     *
     * @return mixed
     */
    public function getMerchantReviewsByIds(array $merchantReviewIds);
}
