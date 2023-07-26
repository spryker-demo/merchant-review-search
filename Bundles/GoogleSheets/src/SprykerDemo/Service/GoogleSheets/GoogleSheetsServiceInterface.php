<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Service\GoogleSheets;

/**
 * @method \SprykerDemo\Service\GoogleSheets\GoogleSheetsServiceFactory getFactory()
 */
interface GoogleSheetsServiceInterface
{
    /**
     * Specification:
     * - Gets array of sheets names.
     *
     * @api
     *
     * @param string $spreadsheetId
     *
     * @return array<string>
     */
    public function getSheetNames(string $spreadsheetId): array;

    /**
     * Specification:
     * - Gets sheet content.
     * - Google sheets range (e.g. sheet!A1:Z100) can be specified.
     *
     * @api
     *
     * @param string $spreadsheetId
     * @param string $range
     *
     * @return array<array<string>>
     */
    public function getSheetContent(string $spreadsheetId, string $range): array;
}
