<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\OmsSubscription\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\OmsSubscription\Business\OmsSubscriptionBusinessFactory getFactory()
 */
class OmsSubscriptionFacade extends AbstractFacade implements OmsSubscriptionFacadeInterface
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
    public function cancelOrderItemSubscription(int $idOrderItem)
    {
        return $this->getFactory()
            ->getOmsFacade()->triggerEventForOrderItems('trigger-subscription-cancellation', [$idOrderItem], []);
    }
}
