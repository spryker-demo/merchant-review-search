<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentativeGui\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\User\Persistence\UserQueryContainerInterface;
use SprykerDemo\Zed\CompanyRepresentative\Business\CompanyRepresentativeFacadeInterface;
use SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Form\CompanyCustomerRepresentativesTypeChoiceFormType;
use SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Form\DataProvider\CompanyCustomerRepresentativesTypeChoiceFormDataProvider;
use SprykerDemo\Zed\CompanyRepresentativeGui\CompanyRepresentativeGuiDependencyProvider;

class CompanyRepresentativeGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Form\CompanyCustomerRepresentativesTypeChoiceFormType
     */
    public function createCompanyCustomerRepresentativesChoiceFormType(): CompanyCustomerRepresentativesTypeChoiceFormType
    {
        return new CompanyCustomerRepresentativesTypeChoiceFormType();
    }

    /**
     * @return \SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Form\DataProvider\CompanyCustomerRepresentativesTypeChoiceFormDataProvider
     */
    public function createCompanyCustomerRepresentativeTypeChoiceFormDataProvider(): CompanyCustomerRepresentativesTypeChoiceFormDataProvider
    {
        return new CompanyCustomerRepresentativesTypeChoiceFormDataProvider(
            $this->getCompanyRepresentativeFacade(),
            $this->getUserQueryContainer(),
        );
    }

    /**
     * @return \SprykerDemo\Zed\CompanyRepresentative\Business\CompanyRepresentativeFacadeInterface
     */
    public function getCompanyRepresentativeFacade(): CompanyRepresentativeFacadeInterface
    {
        return $this->getProvidedDependency(CompanyRepresentativeGuiDependencyProvider::FACADE_COMPANY_REPRESENTATIVE);
    }

    /**
     * @return \Spryker\Zed\User\Persistence\UserQueryContainerInterface
     */
    public function getUserQueryContainer(): UserQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyRepresentativeGuiDependencyProvider::QUERY_CONTAINER_USER);
    }
}
