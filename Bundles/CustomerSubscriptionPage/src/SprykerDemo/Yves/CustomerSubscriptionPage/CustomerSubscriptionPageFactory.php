<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Yves\CustomerSubscriptionPage;

use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;
use Spryker\Client\Sales\SalesClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;
use SprykerDemo\Client\OmsSubscription\OmsSubscriptionClientInterface;
use SprykerDemo\Yves\CustomerSubscriptionPage\Form\FormFactory;
use SprykerDemo\Yves\CustomerSubscriptionPage\Reader\OrderReader;

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
     * @return \SprykerDemo\Yves\CustomerSubscriptionPage\Reader\OrderReader
     */
    public function createOrderReader(): OrderReader
    {
        return new OrderReader(
            $this->getCustomerClient(),
            $this->getSalesClient()
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
     * @return \Pyz\Client\Sales\SalesClient
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
