<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\Executor;

use Generated\Shared\Transfer\DataImporterCombinedReportTransfer;

interface ExecutorInterface
{
    /**
     * @param int $idImportProcess
     *
     * @return \Generated\Shared\Transfer\DataImporterCombinedReportTransfer
     */
    public function execute(int $idImportProcess): DataImporterCombinedReportTransfer;
}
