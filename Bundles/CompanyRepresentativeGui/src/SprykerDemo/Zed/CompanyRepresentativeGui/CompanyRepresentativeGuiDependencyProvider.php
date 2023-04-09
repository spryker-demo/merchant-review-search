<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentativeGui;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentativeGui\CompanyRepresentativeGuiConfig getConfig()
 */
class CompanyRepresentativeGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CUSTOMER_REPRESENTATIVE_FACADE = 'CUSTOMER_REPRESENTATIVE_FACADE';

    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addCustomerRepresentativeFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addCustomerRepresentativeFacade(Container $container): Container
    {
        $container->set(static::CUSTOMER_REPRESENTATIVE_FACADE, function (Container $container) {
            return $container->getLocator()->customerRepresentative()->facade();
        });

        return $container;
    }
}
