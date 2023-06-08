<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Business;

use Orm\Zed\MerchantReviewStorage\Persistence\SpyMerchantReviewStorageQuery;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerDemo\Zed\MerchantReviewStorage\Business\Storage\MerchantReviewStorageWriter;
use SprykerDemo\Zed\MerchantReviewStorage\Business\Storage\MerchantReviewStorageWriterInterface;
use SprykerDemo\Zed\MerchantReviewStorage\MerchantReviewStorageDependencyProvider;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\MerchantReviewStorageConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageEntityManagerInterface getEntityManager()
 */
class MerchantReviewStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerDemo\Zed\MerchantReviewStorage\Business\Storage\MerchantReviewStorageWriterInterface
     */
    public function createMerchantReviewStorageWriter(): MerchantReviewStorageWriterInterface
    {
        return new MerchantReviewStorageWriter(
            $this->getEventBehaviorFacade(),
            $this->getMerchantReviewFacade(),
            $this->getEntityManager(),
        );
    }

    /**
     * @return \Orm\Zed\MerchantReviewStorage\Persistence\SpyMerchantReviewStorageQuery
     */
    public function createMerchantReviewStorageQuery(): SpyMerchantReviewStorageQuery
    {
        return SpyMerchantReviewStorageQuery::create();
    }

    protected function getEventBehaviorFacade()
    {
        return $this->getProvidedDependency(MerchantReviewStorageDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }

    protected function getMerchantReviewFacade()
    {
        return $this->getProvidedDependency(MerchantReviewStorageDependencyProvider::FACADE_MERCHANT_REVIEW);
    }
}
