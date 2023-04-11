<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CustomerRepresentative\Persistence;

use Orm\Zed\CustomerRepresentative\Persistence\SpyCustomerRepresentativeQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use Spryker\Zed\User\Persistence\UserQueryContainerInterface;
use SprykerDemo\Zed\CustomerRepresentative\CustomerRepresentativeDependencyProvider;

/**
 * @method \SprykerDemo\Zed\CustomerRepresentative\CustomerRepresentativeConfig getConfig()
 */
class CustomerRepresentativePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CustomerRepresentative\Persistence\SpyCustomerRepresentativeQuery
     */
    public function createCompanyCustomerRepresentativeQuery(): SpyCustomerRepresentativeQuery
    {
        return SpyCustomerRepresentativeQuery::create();
    }

    /**
     * @return \Spryker\Zed\User\Persistence\UserQueryContainerInterface
     */
    public function getUserQueryContainer(): UserQueryContainerInterface
    {
        return $this->getProvidedDependency(CustomerRepresentativeDependencyProvider::QUERY_CONTAINER_USER);
    }
}
