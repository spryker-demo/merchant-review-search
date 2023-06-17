<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\Uploads;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class UploadsDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FLY_SYSTEM_SERVICE = 'FLY_SYSTEM_SERVICE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addFlySystemService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFlySystemService(Container $container): Container
    {
        $container->set(static::FLY_SYSTEM_SERVICE, function (Container $container) {
            return $container->getLocator()->flysystem()->service();
        });

        return $container;
    }
}
