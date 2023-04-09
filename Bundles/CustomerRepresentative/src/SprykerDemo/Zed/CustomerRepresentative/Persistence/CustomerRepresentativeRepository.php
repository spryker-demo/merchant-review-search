<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CustomerRepresentative\Persistence;

use Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerDemo\Zed\CustomerRepresentative\Persistence\CustomerRepresentativePersistenceFactory getFactory()
 */
class CustomerRepresentativeRepository extends AbstractRepository implements CustomerRepresentativeRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getActiveUsers(): array
    {
        $entities = $this->getFactory()
            ->getUserQueryContainer()
            ->queryUsers()
            ->find();

        return $entities->getArrayCopy();
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer $customerRepresentativesFilterTransfer
     *
     * @return array
     */
    public function findCustomerRepresentatives(CustomerRepresentativesFilterTransfer $customerRepresentativesFilterTransfer): array
    {
        return $this->getFactory()
            ->createCompanyCustomerRepresentativeQuery()
            ->useUserQuery()
            ->endUse()
            ->filterByFkCompany($customerRepresentativesFilterTransfer->getCompanyId())
            ->find()
            ->getData();
    }
}
