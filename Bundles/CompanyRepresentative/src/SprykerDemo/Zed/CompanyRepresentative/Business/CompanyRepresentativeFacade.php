<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentative\Business;

use Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CompanyRepresentativesTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentative\Persistence\CompanyRepresentativeRepositoryInterface getRepository()
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
}
