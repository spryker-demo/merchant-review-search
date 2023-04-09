<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\CustomerRepresentative\Business;

use Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\CustomerRepresentative\Business\CustomerRepresentativeBusinessFactory getFactory()
 * @method \SprykerDemo\Zed\CustomerRepresentative\Persistence\CustomerRepresentativeRepositoryInterface getRepository()()
 */
class CustomerRepresentativeFacade extends AbstractFacade implements CustomerRepresentativeFacadeInterface
{
    public function getActiveUsers(): array
    {
        return $this->getRepository()->getActiveUsers();
    }

    public function findCustomerRepresentatives(CustomerRepresentativesFilterTransfer $customerRepresentativesFilterTransfer): array
    {
        return $this->getRepository()->findCustomerRepresentatives($customerRepresentativesFilterTransfer);
    }
}
