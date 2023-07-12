<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceInterface;
use SprykerDemo\Zed\ImportProcess\Business\ImportProcessFacadeInterface;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Deleter\ImportProcessAssetsDeleter;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\ImportProcessAssetsDownloader;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\ImportProcessAssetsDownloaderInterface;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetDownloader\AbstractSpreadsheetDownloader;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetDownloader\SpreadsheetCsvDownloader;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetReader\SpreadsheetReaderFactory;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetReader\SpreadsheetReaderFactoryInterface;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\ImportProcessCreator\ImportProcessCreator;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\ImportProcessCreator\ImportProcessCreatorInterface;
use SprykerDemo\Zed\ImportProcessSpreadsheet\ImportProcessSpreadsheetDependencyProvider;

/**
 * @method \SprykerDemo\Zed\ImportProcessSpreadsheet\ImportProcessSpreadsheetConfig getConfig()
 */
class ImportProcessSpreadsheetBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\ImportProcessCreator\ImportProcessCreatorInterface
     */
    public function createImportProcessCreator(): ImportProcessCreatorInterface
    {
        return new ImportProcessCreator(
            $this->getImportProcessFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetDownloader\AbstractSpreadsheetDownloader
     */
    public function createSpreadsheetDownloader(): AbstractSpreadsheetDownloader
    {
        return new SpreadsheetCsvDownloader(
            $this->createSpreadsheetReaderFactory(),
            $this->getConfig(),
        );
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetReader\SpreadsheetReaderFactoryInterface
     */
    public function createSpreadsheetReaderFactory(): SpreadsheetReaderFactoryInterface
    {
        return new SpreadsheetReaderFactory($this->getGoogleSpreadsheetsService());
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\ImportProcessAssetsDownloaderInterface
     */
    public function createImportProcessAssetsDownloader(): ImportProcessAssetsDownloaderInterface
    {
        return new ImportProcessAssetsDownloader(
            $this->createSpreadsheetDownloader(),
        );
    }

    public function createImportProcessAssetsDeleter()
    {
        return new ImportProcessAssetsDeleter();
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcess\Business\ImportProcessFacadeInterface
     */
    public function getImportProcessFacade(): ImportProcessFacadeInterface
    {
        return $this->getProvidedDependency(ImportProcessSpreadsheetDependencyProvider::FACADE_IMPORT_PROCESS);
    }

    /**
     * @return \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceInterface
     */
    public function getGoogleSpreadsheetsService(): GoogleSpreadsheetsServiceInterface
    {
        return $this->getProvidedDependency(ImportProcessSpreadsheetDependencyProvider::SERVICE_GOOGLE_SPREADSHEETS);
    }
}
