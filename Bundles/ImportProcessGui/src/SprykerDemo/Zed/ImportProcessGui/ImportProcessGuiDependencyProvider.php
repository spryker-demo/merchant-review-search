<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGui;

use Orm\Zed\ImportProcess\Persistence\SpyImportProcessQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ImportProcessGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_ACL = 'FACADE_ACL';

    /**
     * @var string
     */
    public const FACADE_IMPORT_PROCESS = 'FACADE_IMPORT_PROCESS';

    /**
     * @var string
     */
    public const QUERY_IMPORT_PROCESS = 'QUERY_IMPORT_PROCESS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addAclFacade($container);
        $container = $this->addImportProcessFacade($container);
        $container = $this->addImportProcessQuery($container);

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
    protected function addImportProcessFacade(Container $container): Container
    {
        $container->set(static::FACADE_IMPORT_PROCESS, function (Container $container) {
            return $container->getLocator()->importProcess()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addImportProcessQuery(Container $container): Container
    {
        $container->set(static::QUERY_IMPORT_PROCESS, function () {
            return SpyImportProcessQuery::create();
        });

        return $container;
    }
}
