<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGoogleSheets\Business\Payload\Downloader\SpreadsheetReader;

use Generated\Shared\Transfer\ImportProcessSpreadsheetReaderConfigurationTransfer;
use SprykerDemo\Service\GoogleSheets\GoogleSheetsServiceInterface;

class SpreadsheetReaderFactory implements SpreadsheetReaderFactoryInterface
{
    /**
     * @var \SprykerDemo\Service\GoogleSheets\GoogleSheetsServiceInterface
     */
    protected GoogleSheetsServiceInterface $googleSheetsService;

    /**
     * @param \SprykerDemo\Service\GoogleSheets\GoogleSheetsServiceInterface $googleSheetsService
     */
    public function __construct(GoogleSheetsServiceInterface $googleSheetsService)
    {
        $this->googleSheetsService = $googleSheetsService;
    }

    /**
     * @param \Generated\Shared\Transfer\ImportProcessSpreadsheetReaderConfigurationTransfer $spreadsheetReaderConfigurationTransfer
     *
     * @return \SprykerDemo\Zed\ImportProcessGoogleSheets\Business\Payload\Downloader\SpreadsheetReader\SpreadsheetReaderInterface
     */
    public function createReader(ImportProcessSpreadsheetReaderConfigurationTransfer $spreadsheetReaderConfigurationTransfer): SpreadsheetReaderInterface
    {
        return new SpreadsheetReader($this->googleSheetsService, $spreadsheetReaderConfigurationTransfer);
    }
}
