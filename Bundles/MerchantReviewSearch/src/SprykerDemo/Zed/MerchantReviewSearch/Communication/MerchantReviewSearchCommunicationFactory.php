<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Communication;

use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\MerchantSearch\Business\MerchantSearchFacadeInterface;
use SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchDependencyProvider;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchQueryContainerInterface getQueryContainer()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchRepositoryInterface getRepository()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Business\MerchantReviewSearchFacadeInterface getFacade()
 */
class MerchantReviewSearchCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): EventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(MerchantReviewSearchDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }

    /**
     * @return \Spryker\Zed\MerchantSearch\Business\MerchantSearchFacadeInterface
     */
    public function getMerchantSearchFacade(): MerchantSearchFacadeInterface
    {
        return $this->getProvidedDependency(MerchantReviewSearchDependencyProvider::FACADE_MERCHANT_SEARCH);
    }
}
