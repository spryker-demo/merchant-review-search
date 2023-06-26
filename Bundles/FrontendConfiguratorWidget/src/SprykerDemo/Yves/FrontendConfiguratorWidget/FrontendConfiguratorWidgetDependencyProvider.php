<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Yves\FrontendConfiguratorWidget;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class FrontendConfiguratorWidgetDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_FRONTEND_CONFIG = 'CLIENT_FRONTEND_CONFIG';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = $this->addFrontendConfigClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addFrontendConfigClient(Container $container): Container
    {
        $container->set(static::CLIENT_FRONTEND_CONFIG, function (Container $container) {
            return $container->getLocator()->frontendConfigurator()->client();
        });

        return $container;
    }
}
