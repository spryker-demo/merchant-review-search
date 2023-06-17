<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\Writer;

use Generated\Shared\Transfer\ImportProcessTransfer;

interface WriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function saveImportProcess(
        ImportProcessTransfer $importProcessTransfer
    ): ImportProcessTransfer;
}
