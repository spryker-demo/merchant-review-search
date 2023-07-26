<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\ImportProcess;

use Generated\Shared\Transfer\ImportProcessReportTransfer;
use Generated\Shared\Transfer\ImportProcessTransfer;

interface ImportProcessDataImportExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessReportTransfer
     */
    public function execute(ImportProcessTransfer $importProcessTransfer): ImportProcessReportTransfer;
}
