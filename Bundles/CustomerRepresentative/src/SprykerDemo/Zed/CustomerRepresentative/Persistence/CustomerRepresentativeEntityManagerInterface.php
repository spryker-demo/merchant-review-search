<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CustomerRepresentative\Persistence;

interface CustomerRepresentativeEntityManagerInterface
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
    public function createCompanyCustomerRepresentative(int $companyId, array $userIds): void;

    /**
     * Specification:
     * - Removes company customer representative.
     *
     * @param int $companyId
     * @param array<int> $userIds
     *
     * @return void
     */
    public function removeCompanyCustomerRepresentative(int $companyId, array $userIds): void;

    /**
     * Specification:
     * - Updates company customer representative.
     *
     * @param int $companyId
     * @param array<int> $userIds
     *
     * @return void
     */
    public function updateCompanyCustomerRepresentative(int $companyId, array $userIds): void;
}
