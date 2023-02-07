<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Client\OmsSubscription\Zed;

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
        $itemTransfer = $this->zedStub->call('/oms-subscription/gateway/cancel-order-item-subscription', $itemTransfer);

        return $itemTransfer;
    }
}
