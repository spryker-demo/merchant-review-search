<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\CustomerRepresentative\Persistence;

use Orm\Zed\CustomerRepresentative\Persistence\SpyCustomerRepresentative;
use Propel\Runtime\Collection\Collection;
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
     * @param int[] $userIds
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
     * @param int[] $userIds
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
     * @param int $companyId
     * @param int[] $userIds
     *
     * @return void
     */
    public function updateCompanyCustomerRepresentative(int $companyId, array $userIds): void
    {
        $oldRelationsUserIds = $this->findByCompanyId($companyId)->getColumnValues('FkUser');

        $relationsToDeleteUserIds = array_diff($oldRelationsUserIds, $userIds);
        $relationsToSaveUserIds = array_diff($userIds, $oldRelationsUserIds);

        $this->removeCompanyCustomerRepresentative($companyId, $relationsToDeleteUserIds);
        $this->createCompanyCustomerRepresentative($companyId, $relationsToSaveUserIds);
    }

    /**
     * @param int $companyId
     *
     * @return \Propel\Runtime\Collection\Collection|SpyCustomerRepresentative[]
     */
    public function findByCompanyId(int $companyId): Collection|array
    {
        return $this->getFactory()
            ->createCompanyCustomerRepresentativeQuery()
            ->findByFkCompany($companyId);
    }
}
