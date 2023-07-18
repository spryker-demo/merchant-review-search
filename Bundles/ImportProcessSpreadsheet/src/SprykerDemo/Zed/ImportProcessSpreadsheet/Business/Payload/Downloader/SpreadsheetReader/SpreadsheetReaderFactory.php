<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Payload\Downloader\SpreadsheetReader;

use Generated\Shared\Transfer\ImportProcessSpreadsheetReaderConfigurationTransfer;
use SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceInterface;

class SpreadsheetReaderFactory implements SpreadsheetReaderFactoryInterface
{
    /**
     * @var \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceInterface
     */
    protected GoogleSpreadsheetsServiceInterface $googleSpreadsheetsService;

    /**
     * @param \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceInterface $googleSpreadsheetsService
     */
    public function __construct(GoogleSpreadsheetsServiceInterface $googleSpreadsheetsService)
    {
        $this->googleSpreadsheetsService = $googleSpreadsheetsService;
    }

    /**
     * @param \Generated\Shared\Transfer\ImportProcessSpreadsheetReaderConfigurationTransfer $spreadsheetReaderConfigurationTransfer
     *
     * @return \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Payload\Downloader\SpreadsheetReader\SpreadsheetReaderInterface
     */
    public function createReader(ImportProcessSpreadsheetReaderConfigurationTransfer $spreadsheetReaderConfigurationTransfer): SpreadsheetReaderInterface
    {
        return new SpreadsheetReader($this->googleSpreadsheetsService, $spreadsheetReaderConfigurationTransfer);
    }
}
