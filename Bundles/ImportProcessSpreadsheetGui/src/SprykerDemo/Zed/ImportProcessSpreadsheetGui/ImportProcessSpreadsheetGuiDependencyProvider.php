<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheetGui;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ImportProcessSpreadsheetGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_IMPORT_PROCESS_SPREADSHEET = 'FACADE_IMPORT_PROCESS_SPREADSHEET';

    /**
     * @var string
     */
    public const SERVICE_GOOGLE_SPREADSHEETS = 'SERVICE_GOOGLE_SPREADSHEET';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addImportProcessSpreadsheetFacade($container);
        $container = $this->addGoogleSpreadsheetsService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addImportProcessSpreadsheetFacade(Container $container): Container
    {
        $container->set(static::FACADE_IMPORT_PROCESS_SPREADSHEET, function (Container $container) {
            return $container->getLocator()->importProcessSpreadsheet()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGoogleSpreadsheetsService(Container $container): Container
    {
        $container->set(static::SERVICE_GOOGLE_SPREADSHEETS, function (Container $container) {
            return $container->getLocator()->googleSpreadsheets()->service();
        });

        return $container;
    }
}
