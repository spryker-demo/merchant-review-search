<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Client\MerchantReview\Zed;

use Generated\Shared\Transfer\MerchantReviewRequestTransfer;
use Generated\Shared\Transfer\MerchantReviewResponseTransfer;

interface MerchantReviewStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewResponseTransfer
     */
    public function submitCustomerReview(MerchantReviewRequestTransfer $merchantReviewRequestTransfer): MerchantReviewResponseTransfer;
}
