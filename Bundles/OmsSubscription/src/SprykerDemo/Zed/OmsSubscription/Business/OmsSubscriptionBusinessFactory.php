<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
