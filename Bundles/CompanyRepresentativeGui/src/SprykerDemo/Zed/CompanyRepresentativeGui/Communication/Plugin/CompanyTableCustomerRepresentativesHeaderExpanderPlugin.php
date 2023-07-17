<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Plugin;

use Spryker\Zed\CompanyGuiExtension\Dependency\Plugin\CompanyTableHeaderExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentativeGui\Communication\CompanyRepresentativeGuiCommunicationFactory getFactory()
 */
class CompanyTableCustomerRepresentativesHeaderExpanderPlugin extends AbstractPlugin implements CompanyTableHeaderExpanderPluginInterface
{
    /**
     * @var string
     */
    protected const COL_COMPANY_CUSTOMER_REPRESENTATIVES_LABEL = 'Representative';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<string>
     */
    public function expandHeader(): array
    {
        return [static::COL_COMPANY_CUSTOMER_REPRESENTATIVES_LABEL => static::COL_COMPANY_CUSTOMER_REPRESENTATIVES_LABEL];
    }
}
