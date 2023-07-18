<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Payload\Downloader;

use Exception;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Exception\SpreadsheetDownloaderException;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Payload\Downloader\SpreadsheetReader\SpreadsheetReaderInterface;

class ImportProcessPayloadCsvDataDownloader extends AbstractImportProcessPayloadDataDownloader
{
 /**
  * @param string $spreadsheetUrl
  * @param string $sheetName
  *
  * @return string
  */
    protected function buildFilePath(string $spreadsheetUrl, string $sheetName): string
    {
        $spreadsheetId = $this->getSpreadsheetIdFromUrl($spreadsheetUrl);
        $savePath = $this->getSavePath();

        return sprintf('%s/%s_%s.csv', $savePath, $sheetName, $spreadsheetId);
    }

    /**
     * @return string
     */
    protected function getSavePath(): string
    {
        $savePath = $this->config->getSpreadsheetCsvSaveFilePath();

        if (!is_dir($savePath)) {
            mkdir($savePath, 0777, true);
        }

        return $savePath;
    }

    /**
     * @param string $spreadsheetUrl
     *
     * @throws \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Exception\SpreadsheetDownloaderException
     *
     * @return string
     */
    protected function getSpreadsheetIdFromUrl(string $spreadsheetUrl): string
    {
        $matches = [];

        preg_match('/(?<=\/spreadsheets\/d\/)[a-zA-Z0-9-_]+/', $spreadsheetUrl, $matches);
        $spreadsheetId = $matches[0] ?? null;

        if ($spreadsheetId === null) {
            throw new SpreadsheetDownloaderException('Spreadsheet URL is incorrect');
        }

        return $spreadsheetId;
    }

    /**
     * @param string $filePath
     * @param \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Payload\Downloader\SpreadsheetReader\SpreadsheetReaderInterface $spreadsheetReader
     *
     * @throws \Exception
     *
     * @return void
     */
    protected function writeData(string $filePath, SpreadsheetReaderInterface $spreadsheetReader): void
    {
        $csvFile = fopen($filePath, 'w');

        if (!$csvFile) {
            throw new Exception(sprintf('Could not open file %s', $filePath));
        }

        foreach ($spreadsheetReader as $sheetRow) {
            fputcsv($csvFile, $sheetRow);
        }

        fclose($csvFile);
    }
}
