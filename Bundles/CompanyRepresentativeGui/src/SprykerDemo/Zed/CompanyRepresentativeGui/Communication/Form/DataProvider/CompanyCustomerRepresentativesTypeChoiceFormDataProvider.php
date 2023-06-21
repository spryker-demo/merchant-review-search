<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Form\DataProvider;

use Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CompanyRepresentativesTransfer;
use Orm\Zed\User\Persistence\Map\SpyUserTableMap;
use Spryker\Zed\User\Persistence\UserQueryContainerInterface;
use SprykerDemo\Zed\CompanyRepresentative\Business\CompanyRepresentativeFacadeInterface;
use SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Form\CompanyCustomerRepresentativesTypeChoiceFormType;

class CompanyCustomerRepresentativesTypeChoiceFormDataProvider
{
    /**
     * @var \SprykerDemo\Zed\CompanyRepresentative\Business\CompanyRepresentativeFacadeInterface
     */
    protected $companyRepresentativeFacade;

    /**
     * @var \Spryker\Zed\User\Persistence\UserQueryContainerInterface
     */
    protected $userQueryContainer;

    /**
     * @param \SprykerDemo\Zed\CompanyRepresentative\Business\CompanyRepresentativeFacadeInterface $companyRepresentativeFacade
     * @param \Spryker\Zed\User\Persistence\UserQueryContainerInterface $userQueryContainer
     */
    public function __construct(
        CompanyRepresentativeFacadeInterface $companyRepresentativeFacade,
        UserQueryContainerInterface $userQueryContainer
    ) {
        $this->companyRepresentativeFacade = $companyRepresentativeFacade;
        $this->userQueryContainer = $userQueryContainer;
    }

    /**
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return [
            CompanyCustomerRepresentativesTypeChoiceFormType::OPTION_VALUES_COMPANY_CUSTOMER_REPRESENTATIVES_TYPE_CHOICES => $this->getCompanyRepresentatives(),
        ];
    }

    /**
     * @return array
     */
    protected function getCompanyRepresentatives(): array
    {
        $activeUsers = $this
            ->userQueryContainer
            ->queryUser()
            ->filterByStatus_In([SpyUserTableMap::COL_STATUS_ACTIVE])
            ->find()
            ->getArrayCopy();

        $result = [];
        foreach ($activeUsers as $user) {
            $result[$user->getFirstName() . ' ' . $user->getLastName()] = $user->getIdUser();
        }

        return $result;
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
