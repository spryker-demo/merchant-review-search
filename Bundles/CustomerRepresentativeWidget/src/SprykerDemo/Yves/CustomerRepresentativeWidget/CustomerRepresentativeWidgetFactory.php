<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Yves\CustomerRepresentativeWidget;

use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Yves\Kernel\AbstractFactory;
use Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException;
use SprykerDemo\Client\CustomerRepresentative\CustomerRepresentativeClient;
use SprykerDemo\Client\CustomerRepresentative\CustomerRepresentativeClientInterface;

class CustomerRepresentativeWidgetFactory extends AbstractFactory
{
    /**
     * @return CustomerRepresentativeClientInterface
     * @throws ContainerKeyNotFoundException
     */
    public function getCustomerRepresentativeClient(): CustomerRepresentativeClientInterface
    {
        return $this->getProvidedDependency(CustomerRepresentativeWidgetDependencyProvider::CLIENT_CUSTOMER_REPRESENTATIVE);
    }

    public function getCustomerClient(): CustomerClientInterface
    {
        return $this->getProvidedDependency(CustomerRepresentativeWidgetDependencyProvider::CLIENT_CUSTOMER);
    }
}
