<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\MerchantReviewSearchTransfer;
use Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearch;

class MerchantReviewSearchMapper
{
    /**
     * @param \Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearch $spyMerchantReviewSearch
     * @param \Generated\Shared\Transfer\MerchantReviewSearchTransfer $merchantReviewSearchTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewSearchTransfer
     */
    public function mapMerchantReviewSearchEntityToMerchantReviewSearchTransfer(
        SpyMerchantReviewSearch $spyMerchantReviewSearch,
        MerchantReviewSearchTransfer $merchantReviewSearchTransfer
    ): MerchantReviewSearchTransfer {
        $merchantReviewSearchTransfer->setIdMerchnatReview($spyMerchantReviewSearch->getFkMerchantReview());

        return $merchantReviewSearchTransfer
            ->fromArray($spyMerchantReviewSearch->toArray(), true);
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewSearchTransfer $merchantReviewSearchTransfer
     * @param \Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearch $spyMerchantReviewSearch
     *
     * @return \Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearch
     */
    public function mapMerchantReviewSearchTransferToMerchantReviewSearchEntity(
        MerchantReviewSearchTransfer $merchantReviewSearchTransfer,
        SpyMerchantReviewSearch $spyMerchantReviewSearch
    ): SpyMerchantReviewSearch {
        $spyMerchantReviewSearch->fromArray($merchantReviewSearchTransfer->toArray());
        $spyMerchantReviewSearch->setFkMerchantReview($merchantReviewSearchTransfer->getIdMerchnatReview());

        if ($spyMerchantReviewSearch->getPrimaryKey()) {
            $spyMerchantReviewSearch->setNew(false);
        }

        return $spyMerchantReviewSearch;
    }
}
