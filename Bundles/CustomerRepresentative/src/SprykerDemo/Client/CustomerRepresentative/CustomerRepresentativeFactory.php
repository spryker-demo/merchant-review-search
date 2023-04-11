<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\CustomerRepresentative;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use SprykerDemo\Client\CustomerRepresentative\Zed\CustomerRepresentativeStub;
use SprykerDemo\Client\CustomerRepresentative\Zed\CustomerRepresentativeStubInterface;

class CustomerRepresentativeFactory extends AbstractFactory
{
    public function createCustomerRepresentativeStub(): CustomerRepresentativeStubInterface
    {
        return new CustomerRepresentativeStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient(): ZedRequestClientInterface
    {
        return $this->getProvidedDependency(CustomerRepresentativeDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
