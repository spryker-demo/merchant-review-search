<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\SubscriptionProductOms;

use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerDemo\Client\SubscriptionProductOms\SubscriptionProductOmsFactory getFactory()
 */
class SubscriptionProductOmsClient extends AbstractClient implements SubscriptionProductOmsClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    public function cancelOrderItemSubscription(ItemTransfer $itemTransfer): ItemTransfer
    {
        return $this->getFactory()
            ->createZedSalesStub()
            ->cancelOrderItemSubscription($itemTransfer);
    }
}
