<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Communication;

use Spryker\Zed\EventBehavior\Business\EventBehaviorFacade;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewQueryContainerInterface;
use SprykerDemo\Zed\MerchantReviewStorage\MerchantReviewStorageDependencyProvider;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageRepositoryInterface getRepository()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\MerchantReviewStorageConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Business\MerchantReviewStorageFacadeInterface getFacade()
 */
class MerchantReviewStorageCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): EventBehaviorFacade
    {
        return $this->getProvidedDependency(MerchantReviewStorageDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewQueryContainerInterface
     */
    public function getMerchantReviewQuery(): MerchantReviewQueryContainerInterface
    {
        return $this->getProvidedDependency(MerchantReviewStorageDependencyProvider::QUERY_CONTAINER_MERCHANT_REVIEW);
    }
}
