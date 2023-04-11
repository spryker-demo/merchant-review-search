<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Plugin;

use Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Spryker\Zed\CompanyGuiExtension\Dependency\Plugin\CompanyTableDataExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentativeGui\Communication\CompanyRepresentativeGuiCommunicationFactory getFactory()
 */
class CompanyTableCustomerRepresentativesDataExpanderPlugin extends AbstractPlugin implements CompanyTableDataExpanderPluginInterface
{
    /**
     * @var string
     */
    protected const COL_REPRESENTATIVE = 'representatives';

    /**
     * @var string
     */
    protected const COL_COMPANY_CUSTOMER_REPRESENTATIVES_LABEL = 'Customer representatives';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $item
     *
     * @return array<string>
     */
    public function expandData(array $item): array
    {
        return [static::COL_REPRESENTATIVE => $this->generateUsers($item)];
    }

    /**
     * @param array $item
     *
     * @return string
     */
    protected function generateUsers(array $item): string
    {
        $companyId = $item[SpyCompanyTableMap::COL_ID_COMPANY];

        if (!$companyId) {
            return '';
        }

        $customerRepresentatives = $this->getFactory()
            ->getCustomerRepresentativeFacade()
            ->findCustomerRepresentatives((new CustomerRepresentativesFilterTransfer())->setCompanyId($companyId));

        $usersList = [];

        foreach ($customerRepresentatives as $customerRepresentative) {
            $user = $customerRepresentative->getUser();
            $usersList[] = $user->getFirstName() . ' ' . $user->getLastName();
        }

        return implode(', ', $usersList);
    }
}
