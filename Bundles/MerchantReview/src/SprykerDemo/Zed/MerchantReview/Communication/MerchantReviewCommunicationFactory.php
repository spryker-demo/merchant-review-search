<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;
use SprykerDemo\Zed\MerchantReview\Communication\Controller\Mapper\CustomerReviewSubmitMapper;
use SprykerDemo\Zed\MerchantReview\Communication\Controller\Mapper\CustomerReviewSubmitMapperInterface;
use SprykerDemo\Zed\MerchantReview\MerchantReviewDependencyProvider;

/**
 * @method \SprykerDemo\Zed\MerchantReview\MerchantReviewConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReview\Business\MerchantReviewFacadeInterface getFacade()
 */
class MerchantReviewCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \SprykerDemo\Zed\MerchantReview\Communication\Controller\Mapper\CustomerReviewSubmitMapperInterface
     */
    public function createCustomerReviewSubmitMapper(): CustomerReviewSubmitMapperInterface
    {
        return new CustomerReviewSubmitMapper($this->getLocaleFacade());
    }

    /**
     * @return \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected function getLocaleFacade(): LocaleFacadeInterface
    {
        return $this->getProvidedDependency(MerchantReviewDependencyProvider::FACADE_LOCALE);
    }
}
