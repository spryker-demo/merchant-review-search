<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\OmsSubscription\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Oms\Business\OmsFacadeInterface;
use SprykerDemo\Zed\OmsSubscription\OmsSubscriptionDependencyProvider;

class OmsSubscriptionBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\Oms\Business\OmsFacadeInterface
     */
    public function getOmsFacade(): OmsFacadeInterface
    {
        return $this->getProvidedDependency(OmsSubscriptionDependencyProvider::FACADE_OMS);
    }
}
