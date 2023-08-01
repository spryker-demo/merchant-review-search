<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGoogleSheets\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerDemo\Service\GoogleSheets\GoogleSheetsServiceInterface;
use SprykerDemo\Zed\ImportProcess\Business\ImportProcessFacadeInterface;
use SprykerDemo\Zed\ImportProcessGoogleSheets\Business\ImportProcessCreator\ImportProcessCreator;
use SprykerDemo\Zed\ImportProcessGoogleSheets\Business\ImportProcessCreator\ImportProcessCreatorInterface;
use SprykerDemo\Zed\ImportProcessGoogleSheets\Business\Payload\Deleter\ImportProcessPayloadCsvDataDeleter;
use SprykerDemo\Zed\ImportProcessGoogleSheets\Business\Payload\Deleter\ImportProcessPayloadDataDeleterInterface;
use SprykerDemo\Zed\ImportProcessGoogleSheets\Business\Payload\Downloader\AbstractImportProcessPayloadDataDownloader;
use SprykerDemo\Zed\ImportProcessGoogleSheets\Business\Payload\Downloader\ImportProcessPayloadCsvDataDownloader;
use SprykerDemo\Zed\ImportProcessGoogleSheets\Business\Payload\Downloader\SpreadsheetReader\SpreadsheetReaderFactory;
use SprykerDemo\Zed\ImportProcessGoogleSheets\Business\Payload\Downloader\SpreadsheetReader\SpreadsheetReaderFactoryInterface;
use SprykerDemo\Zed\ImportProcessGoogleSheets\ImportProcessGoogleSheetsDependencyProvider;

/**
 * @method \SprykerDemo\Zed\ImportProcessGoogleSheets\ImportProcessGoogleSheetsConfig getConfig()
 */
class ImportProcessGoogleSheetsBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerDemo\Zed\ImportProcessGoogleSheets\Business\ImportProcessCreator\ImportProcessCreatorInterface
     */
    public function createImportProcessCreator(): ImportProcessCreatorInterface
    {
        return new ImportProcessCreator(
            $this->getImportProcessFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcessGoogleSheets\Business\Payload\Downloader\AbstractImportProcessPayloadDataDownloader
     */
    public function createImportProcessPayloadDataDownloader(): AbstractImportProcessPayloadDataDownloader
    {
        return new ImportProcessPayloadCsvDataDownloader(
            $this->createSpreadsheetReaderFactory(),
            $this->getConfig(),
        );
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcessGoogleSheets\Business\Payload\Downloader\SpreadsheetReader\SpreadsheetReaderFactoryInterface
     */
    public function createSpreadsheetReaderFactory(): SpreadsheetReaderFactoryInterface
    {
        return new SpreadsheetReaderFactory($this->getGoogleSheetsService());
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcessGoogleSheets\Business\Payload\Deleter\ImportProcessPayloadDataDeleterInterface
     */
    public function createImportProcessPayloadDataDeleter(): ImportProcessPayloadDataDeleterInterface
    {
        return new ImportProcessPayloadCsvDataDeleter();
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcess\Business\ImportProcessFacadeInterface
     */
    public function getImportProcessFacade(): ImportProcessFacadeInterface
    {
        return $this->getProvidedDependency(ImportProcessGoogleSheetsDependencyProvider::FACADE_IMPORT_PROCESS);
    }

    /**
     * @return \SprykerDemo\Service\GoogleSheets\GoogleSheetsServiceInterface
     */
    public function getGoogleSheetsService(): GoogleSheetsServiceInterface
    {
        return $this->getProvidedDependency(ImportProcessGoogleSheetsDependencyProvider::SERVICE_GOOGLE_SHEETS);
    }
}
