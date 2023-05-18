<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\SubscriptionProductOms;

use Spryker\Client\Kernel\AbstractFactory;
use SprykerDemo\Client\SubscriptionProductOms\Zed\SalesStub;
use SprykerDemo\Client\SubscriptionProductOms\Zed\SalesStubInterface;

class SubscriptionProductOmsFactory extends AbstractFactory
{
    /**
     * @return \SprykerDemo\Client\SubscriptionProductOms\Zed\SalesStubInterface
     */
    public function createZedSalesStub(): SalesStubInterface
    {
        return new SalesStub(
            $this->getProvidedDependency(SubscriptionProductOmsDependencyProvider::SERVICE_ZED),
        );
    }
}
