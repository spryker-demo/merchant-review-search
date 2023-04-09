<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\CompanyRepresentativeGui\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Form\CompanyCustomerRepresentativesTypeChoiceFormType;
use SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Form\DataProvider\CompanyCustomerRepresentativesTypeChoiceFormDataProvider;
use SprykerDemo\Zed\CompanyRepresentativeGui\CompanyRepresentativeGuiDependencyProvider;
use SprykerDemo\Zed\CustomerRepresentative\Business\CustomerRepresentativeFacadeInterface;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentativeGui\CompanyRepresentativeGuiConfig getConfig()
 */
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
            $this->getCustomerRepresentativeFacade(),
        );
    }

    protected function getCustomerRepresentativeFacade(): CustomerRepresentativeFacadeInterface
    {
        return $this->getProvidedDependency(CompanyRepresentativeGuiDependencyProvider::CUSTOMER_REPRESENTATIVE_FACADE);
    }
}
