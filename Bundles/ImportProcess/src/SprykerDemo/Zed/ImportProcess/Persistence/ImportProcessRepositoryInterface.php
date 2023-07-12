<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Persistence;

use Generated\Shared\Transfer\ImportProcessTransfer;

interface ImportProcessRepositoryInterface
{
    /**
     * @param int $idUser
     *
     * @return array<\Generated\Shared\Transfer\ImportProcessTransfer>
     */
    public function findImportProcessesByIdUser(int $idUser): array;

    /**
     * @param int $idImportProcess
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer|null
     */
    public function findImportProcessById(int $idImportProcess): ?ImportProcessTransfer;
}
