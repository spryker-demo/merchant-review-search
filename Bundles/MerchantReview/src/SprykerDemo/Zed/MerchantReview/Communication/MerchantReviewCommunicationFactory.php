<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\MerchantReview\Communication;

use SprykerDemo\Zed\MerchantReview\Communication\Controller\Mapper\CustomerReviewSubmitMapper;
use SprykerDemo\Zed\MerchantReview\Communication\Controller\Mapper\CustomerReviewSubmitMapperInterface;
use SprykerDemo\Zed\MerchantReview\MerchantReviewDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

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
