<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Yves\CustomerRepresentativeWidget;

use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;
use SprykerDemo\Client\CustomerRepresentative\CompanyRepresentativeClientInterface;

class CustomerRepresentativeWidgetFactory extends AbstractFactory
{
    /**
     * @return \SprykerDemo\Client\CustomerRepresentative\CompanyRepresentativeClientInterface
     */
    public function getCustomerRepresentativeClient(): CompanyRepresentativeClientInterface
    {
        return $this->getProvidedDependency(CustomerRepresentativeWidgetDependencyProvider::CLIENT_CUSTOMER_REPRESENTATIVE);
    }

    /**
     * @return \Spryker\Client\Customer\CustomerClientInterface
     */
    public function getCustomerClient(): CustomerClientInterface
    {
        return $this->getProvidedDependency(CustomerRepresentativeWidgetDependencyProvider::CLIENT_CUSTOMER);
    }
}
