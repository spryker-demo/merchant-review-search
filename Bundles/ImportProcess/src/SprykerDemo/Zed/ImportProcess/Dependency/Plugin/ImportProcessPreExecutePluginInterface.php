<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Dependency\Plugin;

use Generated\Shared\Transfer\ImportProcessTransfer;

interface ImportProcessPreExecutePluginInterface
{
    /**
     * Specification:
     * - Is executed before an import process is run.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function preExecute(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer;
}
