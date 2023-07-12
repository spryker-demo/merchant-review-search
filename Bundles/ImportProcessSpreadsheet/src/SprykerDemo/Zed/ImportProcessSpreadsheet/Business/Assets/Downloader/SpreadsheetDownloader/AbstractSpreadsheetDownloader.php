<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetDownloader;

use Generated\Shared\Transfer\ImportProcessSpreadsheetReaderConfigurationTransfer;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetReader\SpreadsheetReaderFactoryInterface;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetReader\SpreadsheetReaderInterface;
use SprykerDemo\Zed\ImportProcessSpreadsheet\ImportProcessSpreadsheetConfig;

abstract class AbstractSpreadsheetDownloader
{
    /**
     * @var \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetReader\SpreadsheetReaderFactoryInterface
     */
    protected SpreadsheetReaderFactoryInterface $spreadsheetReaderFactory;

    /**
     * @var \SprykerDemo\Zed\ImportProcessSpreadsheet\ImportProcessSpreadsheetConfig
     */
    protected ImportProcessSpreadsheetConfig $config;

    /**
     * @param \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetReader\SpreadsheetReaderFactoryInterface $spreadsheetReaderFactory
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
     * @param string $spreadsheetUrl
     * @param string $sheetName
     * @param string|null $filePath
     *
     * @return string
     */
    public function download(string $spreadsheetUrl, string $sheetName, ?string $filePath = null): string
    {
        $filePath = $filePath ?? $this->buildFilePath($spreadsheetUrl, $sheetName);
        $spreadsheetReader = $this->createSpreadsheetReader($spreadsheetUrl, $sheetName);
        $this->writeData($filePath, $spreadsheetReader);

        return $filePath;
    }

    /**
     * @param string $spreadsheetUrl
     * @param string $sheetName
     *
     * @return \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetReader\SpreadsheetReaderInterface
     */
    protected function createSpreadsheetReader(string $spreadsheetUrl, string $sheetName): SpreadsheetReaderInterface
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
     * @param \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetReader\SpreadsheetReaderInterface $spreadsheetReader
     *
     * @return void
     */
    abstract protected function writeData(string $filePath, SpreadsheetReaderInterface $spreadsheetReader): void;
}
