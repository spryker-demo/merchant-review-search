<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CustomerRepresentative\Persistence;

use Faker\Provider\Company;
use Generated\Shared\Transfer\CompanyResponseTransfer;
use Orm\Zed\CustomerRepresentative\Persistence\Map\SpyCustomerRepresentativeTableMap;
use Orm\Zed\CustomerRepresentative\Persistence\SpyCustomerRepresentative;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \SprykerDemo\Zed\CustomerRepresentative\Persistence\CustomerRepresentativePersistenceFactory getFactory()
 */
class CustomerRepresentativeEntityManager extends AbstractEntityManager implements CustomerRepresentativeEntityManagerInterface
{
    /**
     * @inheritDoc
     *
     * @param int $companyId
     * @param array<int> $userIds
     *
     * @return void
     */
    public function createCompanyCustomerRepresentative(int $companyId, array $userIds): void
    {
        foreach ($userIds as $userId) {
            $companyHasUsers = new SpyCustomerRepresentative();
            $companyHasUsers->setFkCompany($companyId)
                ->setFkUser($userId)
                ->save();
        }
    }

    /**
     * @inheritDoc
     *
     * @param int $companyId
     * @param array<int> $userIds
     *
     * @return void
     */
    public function removeCompanyCustomerRepresentative(int $companyId, array $userIds): void
    {
        if (count($userIds) === 0) {
            return;
        }

        $this->getFactory()
            ->createCompanyCustomerRepresentativeQuery()
            ->filterByFkCompany($companyId)
            ->filterByFkUser_In($userIds)
            ->delete();
    }

    /**
     * @inheritDoc
     *
     * @param \Generated\Shared\Transfer\CompanyResponseTransfer $companyResponseTransfer
     *
     * @return void
     */
    public function updateCompanyCustomerRepresentative(CompanyResponseTransfer $companyResponseTransfer): void
    {
        $userIds = [];
        $companyId = $companyResponseTransfer->getCompanyTransfer()->getIdCompany();

        if($companyResponseTransfer->getCompanyTransfer()->getCustomerRepresentatives())
        {
            $userIds = $companyResponseTransfer->getCompanyTransfer()->getCustomerRepresentatives()->getUserIds();
        }

        $oldRelationsUserIds = $this->getCompanyRepresentatives($companyId);

        $relationsToDeleteUserIds = array_diff($oldRelationsUserIds, $userIds);
        $relationsToSaveUserIds = array_diff($userIds, $oldRelationsUserIds);

        $this->removeCompanyCustomerRepresentative($companyId, $relationsToDeleteUserIds);
        $this->createCompanyCustomerRepresentative($companyId, $relationsToSaveUserIds);
    }

    /**
     * @param int $companyId
     *
     * @return array
     */
    public function getCompanyRepresentatives(int $companyId): array
    {
        return $this->getFactory()
            ->createCompanyCustomerRepresentativeQuery()
            ->select(SpyCustomerRepresentativeTableMap::COL_FK_USER)
            ->findByFkCompany($companyId)
            ->getArrayCopy();
    }
}
