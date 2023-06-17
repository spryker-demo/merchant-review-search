<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\Runner;

use Generated\Shared\Transfer\ImportProcessTransfer;

interface RunnerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return void
     */
    public function runDetachedImportProcess(ImportProcessTransfer $importProcessTransfer): void;
}
