<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CustomerRepresentative\Communication\Plugin\Company;

use Generated\Shared\Transfer\CompanyResponseTransfer;
use Spryker\Zed\CompanyExtension\Dependency\Plugin\CompanyPostSavePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerDemo\Zed\CustomerRepresentative\Communication\CustomerRepresentativeCommunicationFactory getFactory()
 */
class SaveCompanyRepresentativePlugin extends AbstractPlugin implements CompanyPostSavePluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyResponseTransfer $companyResponseTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyResponseTransfer
     */
    public function postSave(CompanyResponseTransfer $companyResponseTransfer): CompanyResponseTransfer
    {
        $this->getFactory()
            ->getCustomerRepresentativeEntityManager()
            ->updateCompanyCustomerRepresentative($companyResponseTransfer);

        return $companyResponseTransfer;
    }
}
