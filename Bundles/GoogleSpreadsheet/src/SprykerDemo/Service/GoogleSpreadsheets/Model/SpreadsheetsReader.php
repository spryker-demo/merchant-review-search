<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Service\GoogleSpreadsheets\Model;

use Google_Client;
use Google_Service_Sheets;
use SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsConfig;

class SpreadsheetsReader implements SpreadsheetsReaderInterface
{
    /**
     * @var \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsConfig
     */
    protected GoogleSpreadsheetsConfig $config;

    /**
     * @param \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsConfig $config
     */
    public function __construct(GoogleSpreadsheetsConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $spreadsheetId
     *
     * @return array
     */
    public function getSheetNames(string $spreadsheetId): array
    {
        $service = $this->getGoogleSpreadsheetsService();
        $sheets = $service->spreadsheets->get($spreadsheetId);

        $sheetNames = [];
        foreach ($sheets as $sheet) {
            $sheetNames[] = $sheet->getProperties()->getTitle();
        }

        return $sheetNames;
    }

    /**
     * @param string $spreadsheetId
     * @param string $sheetName
     *
     * @return array
     */
    public function getSheetContent(string $spreadsheetId, string $sheetName): array
    {
        $service = $this->getGoogleSpreadsheetsService();

        return $service->spreadsheets_values
            ->get($spreadsheetId, $sheetName)
            ->getValues();
    }

    /**
     * @return \Google_Service_Sheets
     */
    protected function getGoogleSpreadsheetsService(): Google_Service_Sheets
    {
        $client = new Google_Client();
        $client->setApplicationName('Product Google Sheet');
        $client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig($this->config->getSpreadsheetsCredentials());

        return new Google_Service_Sheets($client);
    }
}
