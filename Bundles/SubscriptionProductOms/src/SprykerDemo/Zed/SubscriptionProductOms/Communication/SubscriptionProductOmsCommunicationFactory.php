<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\SubscriptionProductOms\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Product\Business\ProductFacadeInterface;
use SprykerDemo\Zed\SubscriptionProductOms\SubscriptionProductOmsDependencyProvider;

/**
 * @method \Spryker\Zed\DummyPayment\DummyPaymentConfig getConfig()
 * @method \Spryker\Zed\DummyPayment\Business\DummyPaymentFacadeInterface getFacade()
 */
class SubscriptionProductOmsCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    public function getProductFacade(): ProductFacadeInterface
    {
        return $this->getProvidedDependency(SubscriptionProductOmsDependencyProvider::FACADE_PRODUCT);
    }
}
