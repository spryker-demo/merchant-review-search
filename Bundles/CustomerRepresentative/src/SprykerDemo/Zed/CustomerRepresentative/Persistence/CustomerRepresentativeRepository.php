<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\CustomerRepresentative\Persistence;

use Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CustomerRepresentativesTransfer;
use Orm\Zed\User\Persistence\Map\SpyUserTableMap;
use Orm\Zed\User\Persistence\SpyUser;
use Propel\Runtime\ActiveQuery\Criteria;
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

//        return array_map(
//            function (SpyUser $userEntity) {
//                return $this->($userEntity);
//            },
//            $entities
//        );
    }

    public function findCustomerRepresentatives(CustomerRepresentativesFilterTransfer $customerRepresentativesFilterTransfer): ?CustomerRepresentativesTransfer
    {
        return $this->getFactory()
            ->createCompanyCustomerRepresentativeQuery()
            ->leftJoinUser()
            ->filterByFkCompany($customerRepresentativesFilterTransfer->getCompanyId())
            ->find();
    }
}
