<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGoogleSheets\Communication\Plugin\ImportProcess;

use Generated\Shared\Transfer\ImportProcessTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerDemo\Zed\ImportProcess\Dependency\Plugin\ImportProcessPreExecutePluginInterface;

/**
 * @method \SprykerDemo\Zed\ImportProcessGoogleSheets\Business\ImportProcessGoogleSheetsFacadeInterface getFacade()
 * @method \SprykerDemo\Zed\ImportProcessGoogleSheets\ImportProcessGoogleSheetsConfig getConfig()
 */
class ImportProcessSpreadsheetPayloadDownloadPlugin extends AbstractPlugin implements ImportProcessPreExecutePluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $importProcessType
     *
     * @return bool
     */
    public function isApplicable(string $importProcessType): bool
    {
        return $importProcessType === $this->getConfig()->getSourceType();
    }

    /**
     * {@inheritDoc}
     * - Downloads spreadsheet content for later use during data import.
     * - Updates import process payload with new file paths.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function preExecute(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer
    {
        return $this->getFacade()->downloadImportProcessPayload($importProcessTransfer);
    }
}
