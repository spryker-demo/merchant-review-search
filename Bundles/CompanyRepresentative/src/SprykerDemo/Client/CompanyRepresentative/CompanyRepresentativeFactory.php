<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\CustomerRepresentative;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use SprykerDemo\Client\CustomerRepresentative\Zed\CompanyRepresentativeStub;
use SprykerDemo\Client\CustomerRepresentative\Zed\CompanyRepresentativeStubInterface;

class CompanyRepresentativeFactory extends AbstractFactory
{
    /**
     * @return \SprykerDemo\Client\CustomerRepresentative\Zed\CompanyRepresentativeStubInterface
     */
    public function createCustomerRepresentativeStub(): CompanyRepresentativeStubInterface
    {
        return new CompanyRepresentativeStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient(): ZedRequestClientInterface
    {
        return $this->getProvidedDependency(CompanyRepresentativeDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
