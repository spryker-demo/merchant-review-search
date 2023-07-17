<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentativeGui;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanyRepresentativeGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_COMPANY_REPRESENTATIVE = 'FACADE_COMPANY_REPRESENTATIVE';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_USER = 'QUERY_CONTAINER_USER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addCompanyRepresentativeFacade($container);
        $container = $this->addUserQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addCompanyRepresentativeFacade(Container $container): Container
    {
        $container->set(static::FACADE_COMPANY_REPRESENTATIVE, function (Container $container) {
            return $container->getLocator()->companyRepresentative()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUserQueryContainer(Container $container): Container
    {
        $container->set(static::QUERY_CONTAINER_USER, function (Container $container) {
            return $container->getLocator()->user()->queryContainer();
        });

        return $container;
    }
}
