<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Business;

use Generated\Shared\Transfer\DataImporterCombinedReportTransfer;
use Generated\Shared\Transfer\ImportProcessTransfer;

interface ImportProcessFacadeInterface
{
    /**
     * Specification:
     * - Saves an import process
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function saveImportProcess(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer;

    /**
     * Specification:
     * - Gets an import process by id
     *
     * @api
     *
     * @param int $idImportProcess
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer|null
     */
    public function findImportProcessById(int $idImportProcess): ?ImportProcessTransfer;

    /**
     * Specification:
     * - Gets all import processes for the user
     *
     * @api
     *
     * @param int $idUser
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer[]
     */
    public function findImportProcessesByIdUser(int $idUser): array;

    /**
     * Specification:
     * - Gets list of available import type in order of correct importers execution
     *
     * @api
     *
     * @return array
     */
    public function getAvailableOrderedImportTypes(): array;

    /**
     * Specification:
     * - Runs import-process:import in background
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return void
     */
    public function runDetachedImportProcess(ImportProcessTransfer $importProcessTransfer): void;

    /**
     * Specification:
     * - Executes import process
     *
     * @api
     *
     * @param int $idImportProcess
     *
     * @return \Generated\Shared\Transfer\DataImporterCombinedReportTransfer
     */
    public function executeImportProcessByIdImportProcess(int $idImportProcess): DataImporterCombinedReportTransfer;
}
