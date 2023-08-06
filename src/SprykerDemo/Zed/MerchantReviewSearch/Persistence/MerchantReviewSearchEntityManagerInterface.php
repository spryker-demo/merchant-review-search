<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Persistence;

use Generated\Shared\Transfer\MerchantReviewSearchTransfer;

interface MerchantReviewSearchEntityManagerInterface
{
    /**
     * @param array<int> $merchantReviewIds
     *
     * @return void
     */
    public function deleteMerchantReviewSearchByMerchantReviewIds(array $merchantReviewIds): void;

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewSearchTransfer $merchantReviewSearchTransfer
     *
     * @return void
     */
    public function saveMerchnatReviewSearch(MerchantReviewSearchTransfer $merchantReviewSearchTransfer): void;
}
