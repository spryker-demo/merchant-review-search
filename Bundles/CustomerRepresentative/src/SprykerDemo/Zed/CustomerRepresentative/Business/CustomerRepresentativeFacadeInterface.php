<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\CustomerRepresentative\Business;

use Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer;

interface CustomerRepresentativeFacadeInterface
{
    public function getActiveUsers();

    public function findCustomerRepresentatives(CustomerRepresentativesFilterTransfer $customerRepresentativesFilterTransfer);
}
