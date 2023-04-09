<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CustomerRepresentative\Persistence;

use Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer;

interface CustomerRepresentativeRepositoryInterface
{
 /**
  * @return array
  */
    public function getActiveUsers(): array;

    /**
     * @param \Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer $customerRepresentativesFilterTransfer
     *
     * @return array
     */
    public function findCustomerRepresentatives(CustomerRepresentativesFilterTransfer $customerRepresentativesFilterTransfer): array;
}
