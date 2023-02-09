<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\OmsSubscription\Business;

interface OmsSubscriptionFacadeInterface
{
    /**
     * Specification:
     * - Trigger the OMS event 'trigger-subscription-cancellation' for the order item id provided.
     *
     * @api
     *
     * @param int $idOrderItem
     *
     * @return mixed
     */
    public function cancelOrderItemSubscription(int $idOrderItem);
}
