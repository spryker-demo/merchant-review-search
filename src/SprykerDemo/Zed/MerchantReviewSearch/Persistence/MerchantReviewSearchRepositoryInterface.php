<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Persistence;

interface MerchantReviewSearchRepositoryInterface
{
    /**
     * @param array<int> $merchantReviewIds
     *
     * @return array<\Generated\Shared\Transfer\MerchantReviewSearchTransfer>
     */
    public function getMerchantReviewSearchTransfersIndexedByMerchantReviewId(array $merchantReviewIds): array;
}
