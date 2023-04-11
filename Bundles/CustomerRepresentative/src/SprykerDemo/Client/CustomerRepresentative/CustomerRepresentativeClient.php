<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\CustomerRepresentative;

use Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CustomerRepresentativesTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * {@inheritDoc}
 *
 * @api
 *
 * @method \SprykerDemo\Client\CustomerRepresentative\CustomerRepresentativeFactory getFactory()
 */
class CustomerRepresentativeClient extends AbstractClient implements CustomerRepresentativeClientInterface
{
    public function findCustomerRepresentatives(CustomerRepresentativesFilterTransfer $customerRepresentativesFilterTransfer): CustomerRepresentativesTransfer
    {
        return $this->getFactory()
            ->createCustomerRepresentativeStub()
            ->findCustomerRepresentatives($customerRepresentativesFilterTransfer);
    }
}
