<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Persistence\Propel\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\MerchantReviewStorageCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewStorageTransfer;
use Orm\Zed\MerchantReviewStorage\Persistence\SpyMerchantReviewStorage;

class MerchantReviewStorageMapper implements MerchantReviewStorageMapperInterface
{
    /**
     * @param \ArrayObject $merchantReviewStorageEntities
     *
     * @return \Generated\Shared\Transfer\MerchantReviewStorageCollectionTransfer
     */
    public function mapMerchantReviewStorageEntitiesToMerchantReviewStorageCollectionTransfer(
        ArrayObject $merchantReviewStorageEntities
    ): MerchantReviewStorageCollectionTransfer {
        $merchantReviews = new ArrayObject();
        $merchantReviewStorageCollectionTransfer = new MerchantReviewStorageCollectionTransfer();

        foreach ($merchantReviewStorageEntities as $merchantReviewStorageEntity) {
            $merchantReviews->append(
                $this->mapMerchantReviewStorageEntityToMerchantReviewStorageTransfer($merchantReviewStorageEntity),
            );
        }

        $merchantReviewStorageCollectionTransfer->setMerchantReviews($merchantReviews);

        return $merchantReviewStorageCollectionTransfer;
    }

    /**
     * @param \Orm\Zed\MerchantReviewStorage\Persistence\SpyMerchantReviewStorage $merchantReviewStorageEntity
     *
     * @return \Generated\Shared\Transfer\MerchantReviewStorageTransfer
     */
    public function mapMerchantReviewStorageEntityToMerchantReviewStorageTransfer(
        SpyMerchantReviewStorage $merchantReviewStorageEntity
    ): MerchantReviewStorageTransfer {
        $merchantReviewStorageTransfer = new MerchantReviewStorageTransfer();

        $merchantReviewStorageTransfer->fromArray($merchantReviewStorageEntity->toArray(), true);

        return $merchantReviewStorageTransfer;
    }
}
