<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Business;

use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use SprykerDemo\Zed\MerchantReview\Business\MerchantReviewFacadeInterface;
use SprykerDemo\Zed\MerchantReviewSearch\Business\Deleter\MerchantReviewSearchDeleter;
use SprykerDemo\Zed\MerchantReviewSearch\Business\Deleter\MerchantReviewSearchDeleterInterface;
use SprykerDemo\Zed\MerchantReviewSearch\Business\Writer\MerchantReviewSearchWriter;
use SprykerDemo\Zed\MerchantReviewSearch\Business\Writer\MerchantReviewSearchWriterInterface;
use SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchDependencyProvider;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchEntityManagerInterface getEntityManager()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchRepositoryInterface getRepository()
 */
class MerchantReviewSearchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerDemo\Zed\MerchantReviewSearch\Business\Writer\MerchantReviewSearchWriterInterface
     */
    public function createMerchantReviewSearchWriter(): MerchantReviewSearchWriterInterface
    {
        return new MerchantReviewSearchWriter(
            $this->getEntityManager(),
            $this->getRepository(),
            $this->getMerchantReviewFacade(),
            $this->getEventBehaviorFacade(),
            $this->getStoreFacade(),
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReview\Business\MerchantReviewFacadeInterface
     */
    public function getMerchantReviewFacade(): MerchantReviewFacadeInterface
    {
        return $this->getProvidedDependency(MerchantReviewSearchDependencyProvider::FACADE_MERCHANT_REVIEW);
    }

    /**
     * @return \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): EventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(MerchantReviewSearchDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }

    /**
     * @return \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    public function getStoreFacade(): StoreFacadeInterface
    {
        return $this->getProvidedDependency(MerchantReviewSearchDependencyProvider::FACADE_STORE);
    }

    /**
     * @return \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    public function getUtilEncodingService(): UtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(MerchantReviewSearchDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReviewSearch\Business\Deleter\MerchantReviewSearchDeleterInterface
     */
    public function createMerchantReviewSearchDeleter(): MerchantReviewSearchDeleterInterface
    {
        return new MerchantReviewSearchDeleter($this->getEntityManager(), $this->getEventBehaviorFacade());
    }
}
