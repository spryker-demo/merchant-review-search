<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentative\Persistence;

use Generated\Shared\Transfer\CompanyResponseTransfer;
use Orm\Zed\CustomerRepresentative\Persistence\Map\SpyCompanyRepresentativeTableMap;
use Orm\Zed\CustomerRepresentative\Persistence\SpyCompanyRepresentative;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentative\Persistence\CompanyRepresentativePersistenceFactory getFactory()
 */
class CompanyRepresentativeEntityManager extends AbstractEntityManager implements CompanyRepresentativeEntityManagerInterface
{
    /**
     * @inheritDoc
     *
     * @param int $companyId
     * @param array<int> $userIds
     *
     * @return void
     */
    public function addCompanyCompanyRepresentatives(int $companyId, array $userIds): void
    {
        foreach ($userIds as $userId) {
            $companyHasUsers = new SpyCompanyRepresentative();
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
    public function removeCompanyCompanyRepresentatives(int $companyId, array $userIds): void
    {
        if (count($userIds) === 0) {
            return;
        }

        $this->getFactory()
            ->createCompanyCompanyRepresentativeQuery()
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
    public function updateCompanyCompanyRepresentatives(CompanyResponseTransfer $companyResponseTransfer): void
    {
        $userIds = [];
        $companyId = $companyResponseTransfer->getCompanyTransfer()->getIdCompany();

        if ($companyResponseTransfer->getCompanyTransfer()->getCompanyRepresentatives()) {
            $userIds = $companyResponseTransfer->getCompanyTransfer()->getCompanyRepresentatives()->getUserIds();
        }

        $oldRelationsUserIds = $this->getCompanyRepresentatives($companyId);

        $relationsToDeleteUserIds = array_diff($oldRelationsUserIds, $userIds);
        $relationsToSaveUserIds = array_diff($userIds, $oldRelationsUserIds);

        $this->removeCompanyCompanyRepresentatives($companyId, $relationsToDeleteUserIds);
        $this->addCompanyCompanyRepresentatives($companyId, $relationsToSaveUserIds);
    }

    /**
     * @param int $companyId
     *
     * @return array
     */
    public function getCompanyRepresentatives(int $companyId): array
    {
        return $this->getFactory()
            ->createCompanyCompanyRepresentativeQuery()
            ->select(SpyCompanyRepresentativeTableMap::COL_FK_USER)
            ->findByFkCompany($companyId)
            ->getArrayCopy();
    }
}
