<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\SubscriptionProductOms\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\SubscriptionProductOms\Business\SubscriptionProductOmsBusinessFactory getFactory()
 */
class SubscriptionProductOmsFacade extends AbstractFacade implements SubscriptionProductOmsFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idOrderItem
     *
     * @return array|null
     */
    public function cancelOrderItemSubscription(int $idOrderItem): ?array
    {
        return $this->getFactory()
            ->getOmsFacade()->triggerEventForOrderItems('trigger-subscription-cancellation', [$idOrderItem], []);
    }
}
