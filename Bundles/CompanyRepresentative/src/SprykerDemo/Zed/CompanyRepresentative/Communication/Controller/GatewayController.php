<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentative\Communication\Controller;

use Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CompanyRepresentativesTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentative\Business\CompanyRepresentativeFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer $companyRepresentativesFilterTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRepresentativesTransfer
     */
    public function findCompanyRepresentativesAction(
        CompanyRepresentativesFilterTransfer $companyRepresentativesFilterTransfer
    ): CompanyRepresentativesTransfer {
        return $this->getFacade()->findCompanyRepresentatives($companyRepresentativesFilterTransfer);
    }
}
