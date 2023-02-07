<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Client\OmsSubscription;

use Generated\Shared\Transfer\ItemTransfer;

interface OmsSubscriptionClientInterface
{
    /**
     * Specification:
     * - Cancels Order Item Subscription.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    public function cancelOrderItemSubscription(ItemTransfer $itemTransfer): ItemTransfer;
}
