<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Yves\CustomerSubscriptionPage;

use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;
use Spryker\Client\Sales\SalesClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;
use SprykerDemo\Client\OmsSubscription\OmsSubscriptionClientInterface;
use SprykerDemo\Yves\CustomerSubscriptionPage\Form\FormFactory;
use SprykerDemo\Yves\CustomerSubscriptionPage\Reader\CustomerOrdersReader;

class CustomerSubscriptionPageFactory extends AbstractFactory
{
    /**
     * @return \SprykerDemo\Yves\CustomerSubscriptionPage\Form\FormFactory
     */
    public function createCustomerFormFactory(): FormFactory
    {
        return new FormFactory();
    }

    /**
     * @return \SprykerDemo\Yves\CustomerSubscriptionPage\Reader\CustomerOrdersReader
     */
    public function createOrderReader(): CustomerOrdersReader
    {
        return new CustomerOrdersReader(
            $this->getCustomerClient(),
            $this->getSalesClient(),
        );
    }

    /**
     * @return \SprykerDemo\Client\OmsSubscription\OmsSubscriptionClientInterface
     */
    public function getCustomerSubscriptionClient(): OmsSubscriptionClientInterface
    {
        return $this->getProvidedDependency(CustomerSubscriptionPageDependencyProvider::CLIENT_CUSTOMER_SUBSCRIPTION);
    }

    /**
     * @return \Spryker\Client\Customer\CustomerClientInterface
     */
    public function getCustomerClient(): CustomerClientInterface
    {
        return $this->getProvidedDependency(CustomerSubscriptionPageDependencyProvider::CLIENT_CUSTOMER);
    }

    /**
     * @return \Spryker\Client\Sales\SalesClientInterface
     */
    public function getSalesClient(): SalesClientInterface
    {
        return $this->getProvidedDependency(CustomerSubscriptionPageDependencyProvider::CLIENT_SALES);
    }

    /**
     * @return \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface
     */
    public function getGlossaryClient(): GlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(CustomerSubscriptionPageDependencyProvider::CLIENT_GLOSSARY);
    }
}
