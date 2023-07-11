<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Yves\FrontendConfiguratorWidget;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class FrontendConfiguratorWidgetDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_FRONTEND_CONFIGURATOR_STORAGE = 'CLIENT_FRONTEND_CONFIGURATOR_STORAGE';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = $this->addFrontendConfiguratorStorageClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addFrontendConfiguratorStorageClient(Container $container): Container
    {
        $container->set(static::CLIENT_FRONTEND_CONFIGURATOR_STORAGE, function (Container $container) {
            return $container->getLocator()->frontendConfiguratorStorage()->client();
        });

        return $container;
    }
}
