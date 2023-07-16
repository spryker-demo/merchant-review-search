<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentative\Business;

use Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CompanyRepresentativesTransfer;
use Generated\Shared\Transfer\CompanyResponseTransfer;

interface CompanyRepresentativeFacadeInterface
{
    /**
     * Specification:
     * - Find All customer representatives related to a company.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer $companyRepresentativesFilterTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRepresentativesTransfer
     */
    public function findCompanyRepresentatives(CompanyRepresentativesFilterTransfer $companyRepresentativesFilterTransfer): CompanyRepresentativesTransfer;

    /**
     * Specification:
     * - Updates company customer representative.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyResponseTransfer $companyResponseTransfer
     *
     * @return void
     */
    public function updateCompanyRepresentatives(CompanyResponseTransfer $companyResponseTransfer): void;
}
