<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Persistence;

use Generated\Shared\Transfer\ImportProcessTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessPersistenceFactory getFactory()
 */
class ImportProcessEntityManager extends AbstractEntityManager implements ImportProcessEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function saveImportProcessEntity(
        ImportProcessTransfer $importProcessTransfer
    ): ImportProcessTransfer {
        $importProcessEntity = $this->getFactory()
            ->createImportProcessQuery()
            ->filterByIdImportProcess($importProcessTransfer->getIdImportProcess())
            ->findOneOrCreate();

        $this->getFactory()
            ->createImportProcessMapper()
            ->mapImportProcessTransferToImportProcessEntity(
                $importProcessTransfer,
                $importProcessEntity
            );

        $importProcessEntity->save();

        $this->getFactory()
            ->createImportProcessMapper()
            ->mapImportProcessEntityToImportProcessTransfer(
                $importProcessEntity,
                $importProcessTransfer
            );

        return $importProcessTransfer;
    }
}
