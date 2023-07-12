<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetReader;

use Generated\Shared\Transfer\ImportProcessSpreadsheetReaderConfigurationTransfer;
use SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsService;

class SpreadsheetReaderFactory implements SpreadsheetReaderFactoryInterface
{
    /**
     * @var \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsService
     */
    protected GoogleSpreadsheetsService $googleSpreadsheetsService;

    /**
     * @param \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsService $googleSpreadsheetsService
     */
    public function __construct(GoogleSpreadsheetsService $googleSpreadsheetsService)
    {
        $this->googleSpreadsheetsService = $googleSpreadsheetsService;
    }

    /**
     * @param \Generated\Shared\Transfer\ImportProcessSpreadsheetReaderConfigurationTransfer $spreadsheetReaderConfigurationTransfer
     *
     * @return \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetReader\SpreadsheetReaderInterface
     */
    public function createReader(ImportProcessSpreadsheetReaderConfigurationTransfer $spreadsheetReaderConfigurationTransfer): SpreadsheetReaderInterface
    {
        return new SpreadsheetReader($this->googleSpreadsheetsService, $spreadsheetReaderConfigurationTransfer);
    }
}
