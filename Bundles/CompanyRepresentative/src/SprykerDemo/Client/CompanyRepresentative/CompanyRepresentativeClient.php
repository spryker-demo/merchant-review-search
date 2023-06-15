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
 * @method \SprykerDemo\Client\CustomerRepresentative\CompanyRepresentativeFactory getFactory()
 */
class CompanyRepresentativeClient extends AbstractClient implements CompanyRepresentativeClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer $customerRepresentativesFilterTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRepresentativesTransfer
     */
    public function findCustomerRepresentatives(CustomerRepresentativesFilterTransfer $customerRepresentativesFilterTransfer): CustomerRepresentativesTransfer
    {
        return $this->getFactory()
            ->createCustomerRepresentativeStub()
            ->findCustomerRepresentatives($customerRepresentativesFilterTransfer);
    }
}
