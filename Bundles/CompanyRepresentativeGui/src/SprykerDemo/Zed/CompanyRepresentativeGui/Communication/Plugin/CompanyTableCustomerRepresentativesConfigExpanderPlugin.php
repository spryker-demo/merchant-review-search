<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Plugin;

use Spryker\Zed\CompanyGuiExtension\Dependency\Plugin\CompanyTableConfigExpanderPluginInterface;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentativeGui\Communication\CompanyRepresentativeGuiCommunicationFactory getFactory()
 */
class CompanyTableCustomerRepresentativesConfigExpanderPlugin extends AbstractPlugin implements CompanyTableConfigExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    public function expandConfig(TableConfiguration $config): TableConfiguration
    {
        return $config;
    }
}
