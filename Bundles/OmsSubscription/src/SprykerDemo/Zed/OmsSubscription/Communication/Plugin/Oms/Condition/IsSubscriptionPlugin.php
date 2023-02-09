<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\OmsSubscription\Communication\Plugin\Oms\Condition;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface;

/**
 * @method \SprykerDemo\Zed\OmsSubscription\Communication\OmsSubscriptionCommunicationFactory getFactory()
 * @method \SprykerDemo\Zed\OmsSubscription\Business\OmsSubscriptionFacadeInterface getFacade()
 */
class IsSubscriptionPlugin extends AbstractPlugin implements ConditionInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function check(SpySalesOrderItem $orderItem): bool
    {
        $concreteProduct = $this->getFactory()->getProductFacade()->getProductConcrete($orderItem->getSku());

        return isset($concreteProduct->getAttributes()['subscription_interval']) && $concreteProduct->getAttributes()['subscription_interval'] !== null;
    }
}
