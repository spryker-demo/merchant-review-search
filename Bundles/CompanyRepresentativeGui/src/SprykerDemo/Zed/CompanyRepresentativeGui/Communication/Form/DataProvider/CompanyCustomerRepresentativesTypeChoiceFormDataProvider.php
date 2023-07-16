<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Form\DataProvider;

use Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CompanyRepresentativesTransfer;
use SprykerDemo\Zed\CompanyRepresentative\Business\CompanyRepresentativeFacadeInterface;
use SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Form\CompanyCustomerRepresentativesTypeChoiceFormType;

class CompanyCustomerRepresentativesTypeChoiceFormDataProvider
{
    /**
     * @var \SprykerDemo\Zed\CompanyRepresentative\Business\CompanyRepresentativeFacadeInterface
     */
    protected $companyRepresentativeFacade;

    /**
     * @param \SprykerDemo\Zed\CompanyRepresentative\Business\CompanyRepresentativeFacadeInterface $companyRepresentativeFacade
     */
    public function __construct(
        CompanyRepresentativeFacadeInterface $companyRepresentativeFacade
    ) {
        $this->companyRepresentativeFacade = $companyRepresentativeFacade;
    }

    /**
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        $allRepresentatives = $this->companyRepresentativeFacade->getAllRepresentatives();

        return [
            CompanyCustomerRepresentativesTypeChoiceFormType::OPTION_VALUES_COMPANY_CUSTOMER_REPRESENTATIVES_TYPE_CHOICES => $allRepresentatives,
        ];
    }

    /**
     * @param int|null $idCompany
     *
     * @return \Generated\Shared\Transfer\CompanyRepresentativesTransfer
     */
    public function getData(?int $idCompany = null): CompanyRepresentativesTransfer
    {
        $companyRepresentativeTransfer = new CompanyRepresentativesTransfer();

        if ($idCompany === null) {
            return $companyRepresentativeTransfer;
        }

        $companyRepresentativeFilterTransfer = new CompanyRepresentativesFilterTransfer();

        return $this->companyRepresentativeFacade->findCompanyRepresentatives($companyRepresentativeFilterTransfer->setCompanyId($idCompany));
    }
}
