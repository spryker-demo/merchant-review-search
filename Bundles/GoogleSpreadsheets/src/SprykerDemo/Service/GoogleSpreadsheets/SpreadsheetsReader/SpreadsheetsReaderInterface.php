<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Service\GoogleSpreadsheets\SpreadsheetsReader;

interface SpreadsheetsReaderInterface
{
    /**
     * @param string $spreadsheetUrl
     *
     * @return array<string>
     */
    public function getSheetNames(string $spreadsheetUrl): array;

    /**
     * @param string $spreadsheetUrl
     * @param string $range
     *
     * @throws \SprykerDemo\Service\GoogleSpreadsheets\Exception\SpreadsheetsException
     *
     * @return array<array<string>>
     */
    public function getSheetContent(string $spreadsheetUrl, string $range): array;
}
