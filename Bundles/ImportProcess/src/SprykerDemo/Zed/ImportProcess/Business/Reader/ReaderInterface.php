<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\Reader;

use Generated\Shared\Transfer\ImportProcessTransfer;

interface ReaderInterface
{
    /**
     * @param int $idUser
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer[]
     */
    public function findImportProcessesByIdUser(int $idUser): array;

    /**
     * @param int $idImportProcess
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer|null
     */
    public function findImportProcessById(int $idImportProcess): ?ImportProcessTransfer;
}
