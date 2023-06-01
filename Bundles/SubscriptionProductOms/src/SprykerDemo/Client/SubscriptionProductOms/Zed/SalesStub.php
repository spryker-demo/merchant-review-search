<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\SubscriptionProductOms\Zed;

use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Client\ZedRequest\ZedRequestClient;

class SalesStub implements SalesStubInterface
{
    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClient
     */
    protected $zedStub;

    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClient $zedStub
     */
    public function __construct(ZedRequestClient $zedStub)
    {
        $this->zedStub = $zedStub;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    public function cancelOrderItemSubscription(ItemTransfer $itemTransfer): ItemTransfer
    {
        /** @var \Generated\Shared\Transfer\ItemTransfer $itemTransfer */
        $itemTransfer = $this->zedStub->call('/subscription-product-oms/gateway/cancel-order-item-subscription', $itemTransfer);

        return $itemTransfer;
    }
}
