<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\Runner;

use Generated\Shared\Transfer\ImportProcessTransfer;
use SprykerDemo\Zed\ImportProcess\Communication\Console\ImportProcessConsole;

class Runner implements RunnerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return void
     */
    public function runDetachedImportProcess(ImportProcessTransfer $importProcessTransfer): void
    {
        shell_exec('../../vendor/bin/console ' . ImportProcessConsole::COMMAND_NAME . ' ' . $importProcessTransfer->getIdImportProcess() . ' > /dev/null 2>/dev/null &');
    }
}
