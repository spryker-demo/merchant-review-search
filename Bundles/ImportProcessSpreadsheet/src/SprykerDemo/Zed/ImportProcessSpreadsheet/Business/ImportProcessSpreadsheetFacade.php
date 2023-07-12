<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet\Business;

use Generated\Shared\Transfer\ImportProcessTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\ImportProcessSpreadsheetBusinessFactory getFactory()
 */
class ImportProcessSpreadsheetFacade extends AbstractFacade implements ImportProcessSpreadsheetFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $spreadsheetUrl
     * @param array<string> $sheetNames
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function createImportProcess(string $spreadsheetUrl, array $sheetNames): ImportProcessTransfer
    {
        return $this->getFactory()
            ->createImportProcessCreator()
            ->createImportProcess($spreadsheetUrl, $sheetNames);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<string>
     */
    public function getAllowedSheetNames(): array
    {
        return $this->getFactory()->getConfig()->getAllowedSheetNames();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function downloadImportProcessPayloadAssets(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer
    {
        return $this->getFactory()->createImportProcessAssetsDownloader()->downloadAssets($importProcessTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function cleanupImportProcessPayloadAssets(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer
    {
        return $this->getFactory()->createImportProcessAssetsDeleter()->deleteAssets($importProcessTransfer);
    }
}
