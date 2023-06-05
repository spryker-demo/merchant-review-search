<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CustomerRepresentative\Persistence;

use Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CustomerRepresentativesTransfer;
use Generated\Shared\Transfer\UserTransfer;
use Orm\Zed\User\Persistence\Map\SpyUserTableMap;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerDemo\Zed\CustomerRepresentative\Persistence\CustomerRepresentativePersistenceFactory getFactory()
 */
class CustomerRepresentativeRepository extends AbstractRepository implements CustomerRepresentativeRepositoryInterface
{
    /**
     * @return array
     */
    public function getActiveUsers(): array
    {
        $entities = $this->getFactory()
            ->getUserQueryContainer()
            ->queryUser()
            ->filterByStatus_In([SpyUserTableMap::COL_STATUS_ACTIVE])
            ->find();

        return $entities->getArrayCopy();
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer $customerRepresentativesFilterTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRepresentativesTransfer
     */
    public function findCustomerRepresentatives(CustomerRepresentativesFilterTransfer $customerRepresentativesFilterTransfer): CustomerRepresentativesTransfer
    {
        $customerRepresentativesCollection = $this->getFactory()
            ->createCompanyCustomerRepresentativeQuery()
            ->filterByFkCompany($customerRepresentativesFilterTransfer->getCompanyId())
            ->useUserQuery()
            ->endUse()
            ->find();

        return $this->mapCustomerRepresentativesCollectionToTransfer($customerRepresentativesCollection, $customerRepresentativesFilterTransfer->getCompanyId());
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $customerRepresentativesCollection
     * @param int $companyId
     *
     * @return \Generated\Shared\Transfer\CustomerRepresentativesTransfer
     */
    protected function mapCustomerRepresentativesCollectionToTransfer(
        ObjectCollection $customerRepresentativesCollection,
        int $companyId
    ): CustomerRepresentativesTransfer {
        $customerRepresentativesTransfer = new CustomerRepresentativesTransfer();

        foreach ($customerRepresentativesCollection as $customerRepresentative) {
            $customerRepresentativesTransfer->addUserId($customerRepresentative->getUser()->getIdUser());
            $userTransfer = (new UserTransfer())->fromArray($customerRepresentative->getUser()->toArray(), true);
            $customerRepresentativesTransfer->addUser($userTransfer);
        }

        $customerRepresentativesTransfer->setCompanyId($companyId);

        return $customerRepresentativesTransfer;
    }
}
