<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\MerchantReview\Communication\Controller\Mapper;

use Generated\Shared\Transfer\MerchantReviewRequestTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;

interface CustomerReviewSubmitMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function mapRequestTransfer(MerchantReviewRequestTransfer $merchantReviewRequestTransfer): MerchantReviewTransfer;
}
