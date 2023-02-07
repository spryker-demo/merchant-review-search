<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Client\OmsSubscription;

use Spryker\Client\Kernel\AbstractFactory;
use SprykerDemo\Client\OmsSubscription\Zed\SalesStub;
use SprykerDemo\Client\OmsSubscription\Zed\SalesStubInterface;

class OmsSubscriptionFactory extends AbstractFactory
{
    /**
     * @return \SprykerDemo\Client\OmsSubscription\Zed\SalesStubInterface
     */
    public function createZedSalesStub(): SalesStubInterface
    {
        return new SalesStub(
            $this->getProvidedDependency(OmsSubscriptionDependencyProvider::SERVICE_ZED),
        );
    }
}
