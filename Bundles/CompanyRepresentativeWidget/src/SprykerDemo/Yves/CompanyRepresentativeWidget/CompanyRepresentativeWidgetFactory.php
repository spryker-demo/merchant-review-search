<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Yves\CompanyRepresentativeWidget;

use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;
use SprykerDemo\Client\CompanyRepresentative\CompanyRepresentativeClientInterface;

class CompanyRepresentativeWidgetFactory extends AbstractFactory
{
    /**
     * @return \SprykerDemo\Client\CompanyRepresentative\CompanyRepresentativeClientInterface
     */
    public function getCompanyRepresentativeClient(): CompanyRepresentativeClientInterface
    {
        return $this->getProvidedDependency(CompanyRepresentativeWidgetDependencyProvider::CLIENT_COMPANY_REPRESENTATIVE);
    }

    /**
     * @return \Spryker\Client\Customer\CustomerClientInterface
     */
    public function getCustomerClient(): CustomerClientInterface
    {
        return $this->getProvidedDependency(CompanyRepresentativeWidgetDependencyProvider::CLIENT_CUSTOMER);
    }
}
