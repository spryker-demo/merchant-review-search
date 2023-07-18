<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Service\GoogleSheets\SpreadsheetsReader;

use Google\Service\Exception;
use Google_Service_Sheets;
use SprykerDemo\Service\GoogleSheets\Exception\SpreadsheetsException;
use SprykerDemo\Service\GoogleSheets\GoogleSheetsConfig;

class SpreadsheetsReader implements SpreadsheetsReaderInterface
{
    /**
     * @var \Google_Service_Sheets
     */
    protected Google_Service_Sheets $googleSheetsService;

    /**
     * @var \SprykerDemo\Service\GoogleSheets\GoogleSheetsConfig
     */
    protected GoogleSheetsConfig $config;

    /**
     * @param \Google_Service_Sheets $googleSheetsService
     * @param \SprykerDemo\Service\GoogleSheets\GoogleSheetsConfig $config
     */
    public function __construct(Google_Service_Sheets $googleSheetsService, GoogleSheetsConfig $config)
    {
        $this->googleSheetsService = $googleSheetsService;
        $this->config = $config;
    }

    /**
     * @param string $spreadsheetUrl
     *
     * @return array<string>
     */
    public function getSheetNames(string $spreadsheetUrl): array
    {
        $sheets = $this->googleSheetsService->spreadsheets->get($this->getSheetIdFromUrl($spreadsheetUrl));

        $sheetNames = [];

        foreach ($sheets as $sheet) {
            $sheetNames[] = $sheet->getProperties()->getTitle();
        }

        return $sheetNames;
    }

    /**
     * @param string $spreadsheetUrl
     * @param string $range
     *
     * @throws \SprykerDemo\Service\GoogleSheets\Exception\SpreadsheetsException
     *
     * @return array<array<string>>
     */
    public function getSheetContent(string $spreadsheetUrl, string $range): array
    {
        try {
            $values = $this->googleSheetsService
                ->spreadsheets_values
                ->get($this->getSheetIdFromUrl($spreadsheetUrl), $range)
                ->getValues();
        } catch (Exception $exception) {
            throw new SpreadsheetsException($exception->getMessage(), $exception->getCode(), $exception);
        }

        if ($values === null) {
            return [];
        }

        return $values;
    }

    /**
     * @param string $spreadsheetUrl
     *
     * @throws \SprykerDemo\Service\GoogleSheets\Exception\SpreadsheetsException
     *
     * @return string
     */
    protected function getSheetIdFromUrl(string $spreadsheetUrl): string
    {
        $matches = [];

        preg_match('/(?<=\/spreadsheets\/d\/)[a-zA-Z0-9-_]+/', $spreadsheetUrl, $matches);
        $spreadsheetId = $matches[0] ?? null;

        if ($spreadsheetId === null) {
            throw new SpreadsheetsException('Spreadsheet URL is incorrect');
        }

        return $spreadsheetId;
    }
}
