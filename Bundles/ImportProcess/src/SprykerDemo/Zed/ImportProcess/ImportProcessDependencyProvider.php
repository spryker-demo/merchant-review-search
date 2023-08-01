<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ImportProcessDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_DATA_IMPORT = 'FACADE_DATA_IMPORT';

    /**
     * @var string
     */
    public const FACADE_ACL = 'FACADE_ACL';

    /**
     * @var string
     */
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';

    /**
     * @var string
     */
    public const PLUGINS_IMPORT_PROCESS_PRE_EXECUTE = 'PLUGINS_IMPORT_PROCESS_PRE_EXECUTE';

    /**
     * @var string
     */
    public const PLUGINS_IMPORT_PROCESS_POST_EXECUTE = 'PLUGINS_IMPORT_PROCESS_POST_EXECUTE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addDataImportFacade($container);
        $container = $this->addImportProcessPreExecutePlugins($container);
        $container = $this->addImportProcessPostExecutePlugins($container);
        $container = $this->addAclFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addEventBehaviorFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addDataImportFacade(Container $container): Container
    {
        $container->set(static::FACADE_DATA_IMPORT, function (Container $container) {
            return $container->getLocator()->dataImport()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAclFacade(Container $container): Container
    {
        $container->set(static::FACADE_ACL, function (Container $container) {
            return $container->getLocator()->acl()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addEventBehaviorFacade(Container $container): Container
    {
        $container->set(static::FACADE_EVENT_BEHAVIOR, function (Container $container) {
            return $container->getLocator()->eventBehavior()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addImportProcessPreExecutePlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_IMPORT_PROCESS_PRE_EXECUTE, function () {
            return $this->getImportProcessPreExecutePlugins();
        });

        return $container;
    }

    /**
     * @return array<\SprykerDemo\Zed\ImportProcess\Dependency\Plugin\ImportProcessPreExecutePluginInterface>
     */
    protected function getImportProcessPreExecutePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addImportProcessPostExecutePlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_IMPORT_PROCESS_POST_EXECUTE, function () {
            return $this->getImportProcessPostExecutePlugins();
        });

        return $container;
    }

    /**
     * @return array<\SprykerDemo\Zed\ImportProcess\Dependency\Plugin\ImportProcessPostExecutePluginInterface>
     */
    protected function getImportProcessPostExecutePlugins(): array
    {
        return [];
    }
}
