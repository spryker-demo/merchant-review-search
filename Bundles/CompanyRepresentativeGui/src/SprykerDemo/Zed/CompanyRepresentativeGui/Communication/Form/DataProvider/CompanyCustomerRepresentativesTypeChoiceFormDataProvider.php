<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Form\DataProvider;

use Spryker\Zed\CompanySupplierGui\Communication\Form\CompanyTypeChoiceFormType;
use Spryker\Zed\CompanySupplierGui\Dependency\Facade\CompanySupplierGuiToCompanySupplierFacadeInterface;
use SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Form\CompanyCustomerRepresentativesTypeChoiceFormType;
use SprykerDemo\Zed\CustomerRepresentative\Business\CustomerRepresentativeFacadeInterface;

class CompanyCustomerRepresentativesTypeChoiceFormDataProvider
{
    /**
     * @var \SprykerDemo\Zed\CustomerRepresentative\Business\CustomerRepresentativeFacadeInterface
     */
    protected $customerRepresentativeFacade;

    /**
     * @param \SprykerDemo\Zed\CustomerRepresentative\Business\CustomerRepresentativeFacadeInterface $customerRepresentativeFacade
     */
    public function __construct(
        CustomerRepresentativeFacadeInterface $customerRepresentativeFacade
    ) {
        $this->customerRepresentativeFacade = $customerRepresentativeFacade;
    }

    /**
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return [
            CompanyCustomerRepresentativesTypeChoiceFormType::OPTION_VALUES_COMPANY_CUSTOMER_REPRESENTATIVES_TYPE_CHOICES => $this->getCustomerRepresentatives(),
        ];
    }

    /**
     * @return array
     */
    protected function getCustomerRepresentatives(): array
    {
        $companyTypeCollection = $this->customerRepresentativeFacade->getActiveUsers();

        $result = [];
        foreach ($companyTypeCollection->getCompanyTypes() as $companyType) {
            $result[$companyType->getName()] = $companyType->getIdCompanyType();
        }

        return $result;
    }
}
