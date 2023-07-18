<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Persistence;

use Orm\Zed\MerchantReviewStorage\Persistence\SpyMerchantReviewStorageQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerDemo\Zed\MerchantReviewStorage\Persistence\Propel\Mapper\MerchantReviewStorageMapper;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\MerchantReviewStorageConfig getConfig()
 */
class MerchantReviewStoragePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\MerchantReviewStorage\Persistence\SpyMerchantReviewStorageQuery
     */
    public function createMerchantReviewStorageQuery(): SpyMerchantReviewStorageQuery
    {
        return SpyMerchantReviewStorageQuery::create();
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReviewStorage\Persistence\Propel\Mapper\MerchantReviewStorageMapper
     */
    public function createMerchantReviewStorageMapper(): MerchantReviewStorageMapper
    {
        return new MerchantReviewStorageMapper();
    }
}
