<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet\Business;

use Generated\Shared\Transfer\ImportProcessTransfer;

interface ImportProcessSpreadsheetFacadeInterface
{
    /**
     * Specification:
     * - Creates spreadsheet import process.
     *
     * @api
     *
     * @param string $spreadsheetUrl
     * @param array<string> $sheetNames
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function createImportProcess(string $spreadsheetUrl, array $sheetNames): ImportProcessTransfer;

    /**
     * Specification:
     * - Downloads data from the spreadsheets used as payload.
     * - Updates import process payload with new file paths.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function downloadImportProcessPayloadAssets(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer;

    /**
     * Specification:
     * - Removes the previously downloaded payload assets.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function cleanupImportProcessPayloadAssets(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer;

    /**
     * Specification:
     * - Gets applicable sorted spreadsheet sheet names.
     *
     * @api
     *
     * @return array<string>
     */
    public function getAllowedSheetNames(): array;
}
