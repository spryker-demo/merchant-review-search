<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
