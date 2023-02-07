<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\OmsSubscription\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Product\Business\ProductFacadeInterface;
use SprykerDemo\Zed\OmsSubscription\OmsSubscriptionDependencyProvider;

/**
 * @method \Spryker\Zed\DummyPayment\DummyPaymentConfig getConfig()
 * @method \Spryker\Zed\DummyPayment\Business\DummyPaymentFacadeInterface getFacade()
 */
class OmsSubscriptionCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    public function getProductFacade(): ProductFacadeInterface
    {
        return $this->getProvidedDependency(OmsSubscriptionDependencyProvider::FACADE_PRODUCT);
    }
}
