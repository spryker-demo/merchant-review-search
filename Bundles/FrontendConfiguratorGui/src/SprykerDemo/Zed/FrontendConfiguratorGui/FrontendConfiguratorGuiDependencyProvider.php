<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\FrontendConfiguratorGui;

use Spryker\Zed\FileManager\Dependency\Service\FileManagerToFileSystemServiceBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiConfig getConfig()
 */
class FrontendConfiguratorGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FRONTEND_CONFIGURATOR_FACADE = 'FRONTEND_CONFIGURATOR_FACADE';

    /**
     * @var string
     */
    public const SERVICE_FILE_SYSTEM = 'SERVICE_FILE_SYSTEM';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        parent::provideCommunicationLayerDependencies($container);

        $this->addFrontendConfiguratorFacade($container);
        $this->addFileSystemService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFrontendConfiguratorFacade(Container $container): Container
    {
        $container->set(static::FRONTEND_CONFIGURATOR_FACADE, function (Container $container) {
            return $container->getLocator()->frontendConfigurator()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFileSystemService(Container $container)
    {
        $container->set(static::SERVICE_FILE_SYSTEM, function (Container $container) {
            return $container->getLocator()->fileSystem()->service();
        });

        return $container;
    }
}
