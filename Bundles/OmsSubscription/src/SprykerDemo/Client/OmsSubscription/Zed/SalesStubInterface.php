<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Client\OmsSubscription\Zed;

use Generated\Shared\Transfer\ItemTransfer;

interface SalesStubInterface
{
    public function cancelOrderItemSubscription(ItemTransfer $itemTransfer): ItemTransfer;
}
