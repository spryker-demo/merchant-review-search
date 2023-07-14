<?php

namespace SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewTableCriteriaTransfer;

interface MerchantReviewMerchantPortalGuiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTableCriteriaTransfer $merchantReviewTableCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function getMerchantReviewTableData(MerchantReviewTableCriteriaTransfer $merchantReviewTableCriteriaTransfer): MerchantReviewCollectionTransfer;
}
