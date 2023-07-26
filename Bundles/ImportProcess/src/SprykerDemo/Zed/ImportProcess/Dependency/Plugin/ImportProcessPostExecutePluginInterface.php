<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Dependency\Plugin;

use Generated\Shared\Transfer\ImportProcessTransfer;

interface ImportProcessPostExecutePluginInterface
{
    /**
     * Specification:
     * - Checks if this plugin is applicable for provided import process type.
     *
     * @api
     *
     * @param string $importProcessType
     *
     * @return bool
     */
    public function isApplicable(string $importProcessType): bool;

    /**
     * Specification:
     * - Is executed after an import process is run.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function postExecute(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer;
}
