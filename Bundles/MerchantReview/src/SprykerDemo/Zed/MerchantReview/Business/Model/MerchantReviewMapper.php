<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Model;

use Generated\Shared\Transfer\MerchantReviewTransfer;
use Orm\Zed\MerchantReview\Persistence\SpyMerchantReview;

class MerchantReviewMapper implements MerchantReviewMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview
     */
    public function mapMerchantReviewTransferToEntity(MerchantReviewTransfer $merchantReviewTransfer): SpyMerchantReview
    {
        $merchantReviewEntity = new SpyMerchantReview();
        $merchantReviewEntity->fromArray($merchantReviewTransfer->toArray());

        return $merchantReviewEntity;
    }
}
