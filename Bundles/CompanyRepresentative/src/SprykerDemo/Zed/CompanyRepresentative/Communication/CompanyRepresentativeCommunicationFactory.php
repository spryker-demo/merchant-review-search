<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentative\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerDemo\Zed\CompanyRepresentative\Persistence\CompanyRepresentativeEntityManagerInterface;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentative\CompanyRepresentativeConfig getConfig()
 * @method \SprykerDemo\Zed\CompanyRepresentative\Persistence\CompanyRepresentativeEntityManagerInterface getEntityManager()
 */
class CompanyRepresentativeCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \SprykerDemo\Zed\CompanyRepresentative\Persistence\CompanyRepresentativeEntityManagerInterface
     */
    public function getCompanyRepresentativeEntityManager(): CompanyRepresentativeEntityManagerInterface
    {
        return $this->getEntityManager();
    }
}
