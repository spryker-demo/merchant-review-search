<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentative\Persistence;

use Orm\Zed\CompanyRepresentative\Persistence\SpyCompanyRepresentativeQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use Spryker\Zed\User\Persistence\UserQueryContainerInterface;
use SprykerDemo\Zed\CompanyRepresentative\CompanyRepresentativeDependencyProvider;

class CompanyRepresentativePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyRepresentative\Persistence\SpyCompanyRepresentativeQuery
     */
    public function createCompanyCompanyRepresentativeQuery(): SpyCompanyRepresentativeQuery
    {
        return SpyCompanyRepresentativeQuery::create();
    }

    /**
     * @return \Spryker\Zed\User\Persistence\UserQueryContainerInterface
     */
    public function getUserQueryContainer(): UserQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyRepresentativeDependencyProvider::QUERY_CONTAINER_USER);
    }
}
