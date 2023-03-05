<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Persistence;

use Orm\Zed\MerchantReviewStorage\Persistence\SpyMerchantReviewStorageQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewQueryContainerInterface;
use SprykerDemo\Zed\MerchantReviewStorage\MerchantReviewStorageDependencyProvider;
use SprykerDemo\Zed\MerchantReviewStorage\Persistence\Propel\Mapper\MerchantReviewStorageMapper;
use SprykerDemo\Zed\MerchantReviewStorage\Persistence\Propel\Mapper\MerchantReviewStorageMapperInterface;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\MerchantReviewStorageConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageQueryContainerInterface getQueryContainer()
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
     * @return \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewQueryContainerInterface
     */
    public function getMerchantReviewQuery(): MerchantReviewQueryContainerInterface
    {
        return $this->getProvidedDependency(MerchantReviewStorageDependencyProvider::QUERY_CONTAINER_MERCHANT_REVIEW);
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReviewStorage\Persistence\Propel\Mapper\MerchantReviewStorageMapperInterface
     */
    public function createMerchantReviewStorageMapper(): MerchantReviewStorageMapperInterface
    {
        return new MerchantReviewStorageMapper();
    }
}
