<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Business;

use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use SprykerDemo\Zed\MerchantReviewSearch\Business\Search\MerchantReviewSearchWriter;
use SprykerDemo\Zed\MerchantReviewSearch\Business\Search\MerchantReviewSearchWriterInterface;
use SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchDependencyProvider;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchQueryContainerInterface getQueryContainer()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchRepositoryInterface getRepository()
 */
class MerchantReviewSearchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerDemo\Zed\MerchantReviewSearch\Business\Search\MerchantReviewSearchWriterInterface
     */
    public function createMerchantReviewWriter(): MerchantReviewSearchWriterInterface
    {
        return new MerchantReviewSearchWriter(
            $this->getQueryContainer(),
            $this->getUtilEncoding(),
            $this->getStoreFacade(),
            $this->getConfig()->isSendingToQueue(),
        );
    }

    /**
     * @return \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    public function getUtilEncoding(): UtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(MerchantReviewSearchDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    /**
     * @return \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    public function getStoreFacade(): StoreFacadeInterface
    {
        return $this->getProvidedDependency(MerchantReviewSearchDependencyProvider::FACADE_STORE);
    }
}
