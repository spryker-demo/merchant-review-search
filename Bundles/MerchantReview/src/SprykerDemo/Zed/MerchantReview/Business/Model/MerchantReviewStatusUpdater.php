<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Model;

use Generated\Shared\Transfer\MerchantReviewTransfer;
use SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewEntityManagerInterface;

class MerchantReviewStatusUpdater implements MerchantReviewStatusUpdaterInterface
{
    protected MerchantReviewEntityManagerInterface $merchantReviewEntityManager;

    /**
     * @param \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewEntityManagerInterface $merchantReviewEntityManager
     */
    public function __construct(MerchantReviewEntityManagerInterface $merchantReviewEntityManager)
    {
        $this->merchantReviewEntityManager = $merchantReviewEntityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return void
     */
    public function updateMerchantReviewStatus(MerchantReviewTransfer $merchantReviewTransfer): void
    {
        $this->assertMerchantReviewTransfer($merchantReviewTransfer);
        $this->merchantReviewEntityManager->updateMerchantReview($merchantReviewTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return void
     */
    protected function assertMerchantReviewTransfer(MerchantReviewTransfer $merchantReviewTransfer): void
    {
        $merchantReviewTransfer->requireIdMerchantReview();
        $merchantReviewTransfer->requireStatus();
    }
}
