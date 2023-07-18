<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Payload\Downloader;

use Generated\Shared\Transfer\ImportProcessSpreadsheetReaderConfigurationTransfer;
use Generated\Shared\Transfer\ImportProcessTransfer;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Payload\Downloader\SpreadsheetReader\SpreadsheetReaderFactoryInterface;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Payload\Downloader\SpreadsheetReader\SpreadsheetReaderInterface;
use SprykerDemo\Zed\ImportProcessSpreadsheet\ImportProcessSpreadsheetConfig;

abstract class AbstractImportProcessPayloadDataDownloader
{
    /**
     * @var \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Payload\Downloader\SpreadsheetReader\SpreadsheetReaderFactoryInterface
     */
    protected SpreadsheetReaderFactoryInterface $spreadsheetReaderFactory;

    /**
     * @var \SprykerDemo\Zed\ImportProcessSpreadsheet\ImportProcessSpreadsheetConfig
     */
    protected ImportProcessSpreadsheetConfig $config;

    /**
     * @param \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Payload\Downloader\SpreadsheetReader\SpreadsheetReaderFactoryInterface $spreadsheetReaderFactory
     * @param \SprykerDemo\Zed\ImportProcessSpreadsheet\ImportProcessSpreadsheetConfig $config
     */
    public function __construct(
        SpreadsheetReaderFactoryInterface $spreadsheetReaderFactory,
        ImportProcessSpreadsheetConfig $config
    ) {
        $this->spreadsheetReaderFactory = $spreadsheetReaderFactory;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function downloadPayloadData(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer
    {
        foreach ($importProcessTransfer->getPayloadOrFail()->getSourceMaps() as $sourceMapTransfer) {
            $fileName = $this->downloadSheetContent(
                $sourceMapTransfer->getSourceOrFail(),
                $sourceMapTransfer->getImportTypeOrFail(),
            );
            $sourceMapTransfer->setSource($fileName);
            $sourceMapTransfer->setImportType($sourceMapTransfer->getImportType());
        }

        return $importProcessTransfer;
    }

    /**
     * @param string $spreadsheetUrl
     * @param string $sheetName
     *
     * @return string
     */
    protected function downloadSheetContent(string $spreadsheetUrl, string $sheetName): string
    {
        $filePath = $this->buildFilePath($spreadsheetUrl, $sheetName);
        $spreadsheetReader = $this->getSpreadsheetReader($spreadsheetUrl, $sheetName);
        $this->writeData($filePath, $spreadsheetReader);

        return $filePath;
    }

    /**
     * @param string $spreadsheetUrl
     * @param string $sheetName
     *
     * @return \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Payload\Downloader\SpreadsheetReader\SpreadsheetReaderInterface
     */
    protected function getSpreadsheetReader(string $spreadsheetUrl, string $sheetName): SpreadsheetReaderInterface
    {
        $spreadsheetReaderConfigurationTransfer = (new ImportProcessSpreadsheetReaderConfigurationTransfer())
            ->setSpreadsheetUrl($spreadsheetUrl)
            ->setSheetName($sheetName)
            ->setBatchSize($this->config->getSpreadsheetReadChunkSize());

        return $this->spreadsheetReaderFactory->createReader($spreadsheetReaderConfigurationTransfer);
    }

    /**
     * @param string $spreadsheetUrl
     * @param string $sheetName
     *
     * @return string
     */
    abstract protected function buildFilePath(string $spreadsheetUrl, string $sheetName): string;

    /**
     * @param string $filePath
     * @param \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Payload\Downloader\SpreadsheetReader\SpreadsheetReaderInterface $spreadsheetReader
     *
     * @return void
     */
    abstract protected function writeData(string $filePath, SpreadsheetReaderInterface $spreadsheetReader): void;
}
