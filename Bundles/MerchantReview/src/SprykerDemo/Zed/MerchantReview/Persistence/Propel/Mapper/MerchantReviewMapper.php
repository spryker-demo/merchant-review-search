<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Persistence\Propel\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Generated\Shared\Transfer\SpyMerchantReviewEntityTransfer;
use Orm\Zed\MerchantReview\Persistence\SpyMerchantReview;
use Propel\Runtime\Collection\ObjectCollection;

class MerchantReviewMapper
{
    /**
     * @param \Generated\Shared\Transfer\SpyMerchantReviewEntityTransfer $spyMerchantReviewEntityTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function mapMerchantReviewEntityTransferToMerchantReviewTransfer(
        SpyMerchantReviewEntityTransfer $spyMerchantReviewEntityTransfer
    ): MerchantReviewTransfer {
        $merchantReviewTransfer = new MerchantReviewTransfer();

        $merchantReviewTransfer->fromArray($spyMerchantReviewEntityTransfer->toArray(), true);

        return $merchantReviewTransfer;
    }

    /**
     * @param \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview $merchantReviewEntity
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function mapMerchantReviewEntityToMerchantReviewTransfer(SpyMerchantReview $merchantReviewEntity): MerchantReviewTransfer
    {
        $merchantReviewTransfer = new MerchantReviewTransfer();

        $merchantReviewTransfer->fromArray($merchantReviewEntity->toArray(), true);

        return $merchantReviewTransfer;
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $merchantReviewEntities
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function mapMerchantReviewEntitiesToMerchantReviewCollection(ObjectCollection $merchantReviewEntities): MerchantReviewCollectionTransfer
    {
        $merchantReviews = new ArrayObject();
        $merchantReviewsCollectionTransfer = new MerchantReviewCollectionTransfer();

        foreach ($merchantReviewEntities as $merchantReviewEntity) {
            $merchantReviews->append($this->mapMerchantReviewEntityToMerchantReviewTransfer($merchantReviewEntity));
        }

        $merchantReviewsCollectionTransfer->setReviews($merchantReviews);

        return $merchantReviewsCollectionTransfer;
    }
}
