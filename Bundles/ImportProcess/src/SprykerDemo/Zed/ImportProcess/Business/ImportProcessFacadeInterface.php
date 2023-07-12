<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Business;

use Generated\Shared\Transfer\ImportProcessPayloadTransfer;
use Generated\Shared\Transfer\ImportProcessTransfer;

interface ImportProcessFacadeInterface
{
    /**
     * Specification:
     * - Creates new import process from payload and saves it to a database.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ImportProcessPayloadTransfer $importProcessPayloadTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function createImportProcess(ImportProcessPayloadTransfer $importProcessPayloadTransfer): ImportProcessTransfer;

    /**
     * Specification:
     * - Runs a batch of import processes by their ids.
     *
     * @api
     *
     * @param array<int> $importProcessIds
     *
     * @return void
     */
    public function runImportProcesses(array $importProcessIds): void;

    /**
     * Specification:
     * - Gets an import process by id.
     *
     * @api
     *
     * @param int $idImportProcess
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer|null
     */
    public function findImportProcessById(int $idImportProcess): ?ImportProcessTransfer;
}
