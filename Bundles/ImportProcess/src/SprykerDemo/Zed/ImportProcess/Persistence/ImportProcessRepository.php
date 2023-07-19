<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
                new ImportProcessTransfer(),
            );
    }
}
