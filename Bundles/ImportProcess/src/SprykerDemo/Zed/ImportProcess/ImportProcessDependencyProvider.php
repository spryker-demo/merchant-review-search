<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess;

use Pyz\Zed\DataImport\Communication\Plugin\ImportProcess\DataImportByImportProcessPluginInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerDemo\Zed\ImportProcess\Exception\MissingDataImportByImportProcessPluginException;

class ImportProcessDependencyProvider extends AbstractBundleDependencyProvider
{
    public const SERVICE_FLYSYSTEM = 'SERVICE_FLYSYSTEM';
    public const PLUGIN_DATA_IMPORT_BY_IMPORT_PROCESS = 'PLUGIN_DATA_IMPORT_BY_IMPORT_PROCESS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addFlySystemService($container);
        $container = $this->addDataImportByImportServicePlugin($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFlySystemService(Container $container): Container
    {
        $container->set(static::SERVICE_FLYSYSTEM, function (Container $container) {
            return $container->getLocator()->flysystem()->service();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addDataImportByImportServicePlugin(Container $container): Container
    {
        $container->set(static::PLUGIN_DATA_IMPORT_BY_IMPORT_PROCESS, function (Container $container) {
            return $this->createDataImportByImportProcessPlugin($container);
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @throws \SprykerDemo\Zed\ImportProcess\Exception\MissingDataImportByImportProcessPluginException
     *
     * @return \Pyz\Zed\DataImport\Communication\Plugin\ImportProcess\DataImportByImportProcessPluginInterface
     */
    protected function createDataImportByImportProcessPlugin(Container $container): DataImportByImportProcessPluginInterface
    {
        throw new MissingDataImportByImportProcessPluginException(
            sprintf(
                'Missing instance of %s! You need to configure DataImportByImportProcessPlugin ' .
                'in your own ImportProcessDependencyProvider::createDataImportByImportProcessPlugin() ' .
                'to be able to import data.',
                DataImportByImportProcessPluginInterface::class,
            ),
        );
    }
}
