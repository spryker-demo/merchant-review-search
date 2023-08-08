<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerDemo\Zed\MerchantReview\Business\MerchantReviewFacadeInterface;
use SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchDependencyProvider;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchConfig getConfig()
 */
class MerchantReviewSearchCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \SprykerDemo\Zed\MerchantReview\Business\MerchantReviewFacadeInterface
     */
    public function getMerchantReviewFacade(): MerchantReviewFacadeInterface
    {
        return $this->getProvidedDependency(MerchantReviewSearchDependencyProvider::FACADE_MERCHANT_REVIEW);
    }
}
