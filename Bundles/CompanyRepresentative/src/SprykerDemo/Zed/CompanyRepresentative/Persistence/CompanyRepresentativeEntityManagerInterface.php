<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentative\Persistence;

use Generated\Shared\Transfer\CompanyResponseTransfer;

interface CompanyRepresentativeEntityManagerInterface
{
    /**
     * Specification:
     * - Adds new customer representative to a company.
     *
     * @param int $companyId
     * @param array<int> $userIds
     *
     * @return void
     */
    public function addCompanyCompanyRepresentatives(int $companyId, array $userIds): void;

    /**
     * Specification:
     * - Removes company customer representative.
     *
     * @param int $companyId
     * @param array<int> $userIds
     *
     * @return void
     */
    public function removeCompanyCompanyRepresentatives(int $companyId, array $userIds): void;

    /**
     * Specification:
     * - Updates company customer representative.
     *
     * @param \Generated\Shared\Transfer\CompanyResponseTransfer $companyResponseTransfer
     *
     * @return void
     */
    public function updateCompanyCompanyRepresentatives(CompanyResponseTransfer $companyResponseTransfer): void;
}
