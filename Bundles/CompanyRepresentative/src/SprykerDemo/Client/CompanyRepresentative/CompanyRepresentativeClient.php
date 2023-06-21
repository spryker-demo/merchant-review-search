<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\CompanyRepresentative;

use Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CompanyRepresentativesTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * {@inheritDoc}
 *
 * @api
 *
 * @method \SprykerDemo\Client\CompanyRepresentative\CompanyRepresentativeFactory getFactory()
 */
class CompanyRepresentativeClient extends AbstractClient implements CompanyRepresentativeClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer $companyRepresentativesFilterTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRepresentativesTransfer
     */
    public function findCustomerRepresentatives(CompanyRepresentativesFilterTransfer $companyRepresentativesFilterTransfer): CompanyRepresentativesTransfer
    {
        return $this->getFactory()
            ->createCompanyRepresentativeStub()
            ->findCompanyRepresentatives($companyRepresentativesFilterTransfer);
    }
}
