<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Business;

use Generated\Shared\Transfer\DataImporterCombinedReportTransfer;
use Generated\Shared\Transfer\ImportProcessTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\ImportProcess\Business\ImportProcessBusinessFactory getFactory()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessRepositoryInterface getRepository()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface getEntityManager()
 */
class ImportProcessFacade extends AbstractFacade implements ImportProcessFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function saveImportProcess(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer
    {
        return $this->getFactory()
            ->createWriter()
            ->saveImportProcess($importProcessTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idImportProcess
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer|null
     */
    public function findImportProcessById(int $idImportProcess): ?ImportProcessTransfer
    {
        return $this->getFactory()
            ->createReader()
            ->findImportProcessById($idImportProcess);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idUser
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer[]
     */
    public function findImportProcessesByIdUser(int $idUser): array
    {
        $importProcessTransfers = $this->getFactory()
            ->createReader()
            ->findImportProcessesByIdUser($idUser);

        return $importProcessTransfers;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array
     */
    public function getAvailableOrderedImportTypes(): array
    {
        return $this->getFactory()->getConfig()->getAvailableOrderedImportTypes();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return void
     */
    public function runDetachedImportProcess(ImportProcessTransfer $importProcessTransfer): void
    {
        $this->getFactory()->createRunner()->runDetachedImportProcess($importProcessTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idImportProcess
     *
     * @return \Generated\Shared\Transfer\DataImporterCombinedReportTransfer
     */
    public function executeImportProcessByIdImportProcess(int $idImportProcess): DataImporterCombinedReportTransfer
    {
        return $this->getFactory()->createExecutor()->execute($idImportProcess);
    }
}
