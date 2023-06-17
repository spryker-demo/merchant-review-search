<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Persistence;

use Generated\Shared\Transfer\ImportProcessTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessPersistenceFactory getFactory()
 */
class ImportProcessRepository extends AbstractRepository implements ImportProcessRepositoryInterface
{
    /**
     * @param int $idUser
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer[]
     */
    public function findImportProcessesByIdUser(int $idUser): array
    {
        $importProcessEntities = $this->getFactory()
            ->createImportProcessQuery()
            ->filterByFkUser($idUser)
            ->find();

        $importProcessTransfers = [];
        foreach ($importProcessEntities as $importProcessEntity) {
            $importProcessTransfers[] = $this->getFactory()
                ->createImportProcessMapper()
                ->mapImportProcessEntityToImportProcessTransfer(
                    $importProcessEntity,
                    new ImportProcessTransfer()
                );
        }

        return $importProcessTransfers;
    }

    /**
     * @param int $idImportProcess
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer|null
     */
    public function findImportProcessById(int $idImportProcess): ?ImportProcessTransfer
    {
        $importProcessEntity = $this->getFactory()
            ->createImportProcessQuery()
            ->filterByIdImportProcess($idImportProcess)
            ->findOne();

        if (!$importProcessEntity) {
            return null;
        }

        return $this->getFactory()
            ->createImportProcessMapper()
            ->mapImportProcessEntityToImportProcessTransfer(
                $importProcessEntity,
                new ImportProcessTransfer()
            );
    }
}
