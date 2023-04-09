<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Plugin;

use Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Spryker\Zed\CompanyGuiExtension\Dependency\Plugin\CompanyTableConfigExpanderPluginInterface;
use Spryker\Zed\CompanyGuiExtension\Dependency\Plugin\CompanyTableDataExpanderPluginInterface;
use Spryker\Zed\CompanyGuiExtension\Dependency\Plugin\CompanyTableHeaderExpanderPluginInterface;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentativeGui\Communication\CompanyRepresentativeGuiCommunicationFactory getFactory()
 */
class CompanyTableCustomerRepresentativesHeaderExpanderPlugin extends AbstractPlugin implements CompanyTableHeaderExpanderPluginInterface
{
    protected CONST COL_REPRESENTATIVE = 'representatives';
    protected CONST COL_COMPANY_CUSTOMER_REPRESENTATIVES_LABEL = 'Customer representatives';

    public function expandHeader(): array
    {
        return [static::COL_REPRESENTATIVE => static::COL_COMPANY_CUSTOMER_REPRESENTATIVES_LABEL];
    }
}
