<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentative\Persistence;

use Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CompanyRepresentativesTransfer;

interface CompanyRepresentativeRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer $companyRepresentativesFilterTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRepresentativesTransfer
     */
    public function findCompanyRepresentatives(CompanyRepresentativesFilterTransfer $companyRepresentativesFilterTransfer): CompanyRepresentativesTransfer;

    /**
     * @return array
     */
    public function getAllRepresentatives(): array;
}
