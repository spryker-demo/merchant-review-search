<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentative\Business;

use Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CompanyRepresentativesTransfer;
use Generated\Shared\Transfer\CompanyResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentative\Persistence\CompanyRepresentativeRepositoryInterface getRepository()
 * @method \SprykerDemo\Zed\CompanyRepresentative\Persistence\CompanyRepresentativeEntityManagerInterface getEntityManager()
 */
class CompanyRepresentativeFacade extends AbstractFacade implements CompanyRepresentativeFacadeInterface
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
    public function findCompanyRepresentatives(CompanyRepresentativesFilterTransfer $companyRepresentativesFilterTransfer): CompanyRepresentativesTransfer
    {
        return $this->getRepository()->findCompanyRepresentatives($companyRepresentativesFilterTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyResponseTransfer $companyResponseTransfer
     *
     * @return void
     */
    public function updateCompanyRepresentatives(CompanyResponseTransfer $companyResponseTransfer): void
    {
        $this->getEntityManager()->updateCompanyRepresentatives($companyResponseTransfer);
    }
}
