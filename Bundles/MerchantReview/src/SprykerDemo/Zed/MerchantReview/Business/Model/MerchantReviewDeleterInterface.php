<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Model;

use Generated\Shared\Transfer\MerchantReviewTransfer;

interface MerchantReviewDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return void
     */
    public function deleteMerchantReview(MerchantReviewTransfer $merchantReviewTransfer): void;
}
