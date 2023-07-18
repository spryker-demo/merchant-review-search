<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentative\Communication\Plugin\Company;

use Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Customer\Dependency\Plugin\CustomerTransferExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentative\Business\CompanyRepresentativeFacadeInterface getFacade()()
 * @method \SprykerDemo\Zed\CompanyRepresentative\Persistence\CompanyRepresentativeEntityManagerInterface getEntityManager()
 */
class CompanyRepresentativeCustomerTransferExpanderPlugin extends AbstractPlugin implements CustomerTransferExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function expandTransfer(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        if (!$customerTransfer->getCompanyUserTransfer()) {
            return $customerTransfer;
        }

        $companyRepresentativesFilterTransfer = (new CompanyRepresentativesFilterTransfer())
        ->setCompanyId($customerTransfer->getCompanyUserTransfer()->getFkCompany());

        $companyRepresentatives = $this->getFacade()->findCompanyRepresentatives($companyRepresentativesFilterTransfer);
        $customerTransfer->getCompanyUserTransfer()->getCompany()->setCompanyRepresentatives($companyRepresentatives);

        return $customerTransfer;
    }
}
