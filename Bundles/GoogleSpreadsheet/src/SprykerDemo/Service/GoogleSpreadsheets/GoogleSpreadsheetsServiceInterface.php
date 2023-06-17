<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Service\GoogleSpreadsheets;

/**
 * @method \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceFactory getFactory()
 */
interface GoogleSpreadsheetsServiceInterface
{
    /**
     * Specification
     *  - Gets array of sheets names
     *
     * @api
     *
     * @param string $spreadsheetId
     *
     * @return array
     */
    public function getSheetNames(string $spreadsheetId): array;

    /**
     * Specification:
     *  - Gets sheet content
     *
     * @api
     *
     * @param string $spreadsheetId
     * @param string $sheetName
     *
     * @return array
     */
    public function getSheetContent(string $spreadsheetId, string $sheetName): array;
}
