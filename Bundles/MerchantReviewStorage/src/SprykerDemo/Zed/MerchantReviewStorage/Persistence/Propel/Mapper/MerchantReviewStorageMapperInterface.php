<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Persistence\Propel\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\MerchantReviewStorageCollectionTransfer;

interface MerchantReviewStorageMapperInterface
{
    /**
     * @param \ArrayObject $merchantReviewStorageEntities
     *
     * @return \Generated\Shared\Transfer\MerchantReviewStorageCollectionTransfer
     */
    public function mapMerchantReviewStorageEntitiesToMerchantReviewStorageCollectionTransfer(
        ArrayObject $merchantReviewStorageEntities
    ): MerchantReviewStorageCollectionTransfer;
}
