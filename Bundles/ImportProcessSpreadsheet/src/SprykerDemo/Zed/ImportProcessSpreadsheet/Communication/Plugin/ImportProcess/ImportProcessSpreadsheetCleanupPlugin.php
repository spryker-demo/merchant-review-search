<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet\Communication\Plugin\ImportProcess;

use Generated\Shared\Transfer\ImportProcessTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerDemo\Zed\ImportProcess\Dependency\Plugin\ImportProcessPostExecutePluginInterface;

/**
 * @method \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\ImportProcessSpreadsheetFacadeInterface getFacade()
 */
class ImportProcessSpreadsheetCleanupPlugin extends AbstractPlugin implements ImportProcessPostExecutePluginInterface
{
    /**
     * {@inheritDoc}
     * - Deletes previously downloaded data import assets.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function postExecute(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer
    {
        return $this->getFacade()->cleanupImportProcessPayloadAssets($importProcessTransfer);
    }
}
