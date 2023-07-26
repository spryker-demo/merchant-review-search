<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Business;

use Generated\Shared\Transfer\ImportProcessPayloadTransfer;
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
     * @param \Generated\Shared\Transfer\ImportProcessPayloadTransfer $importProcessPayloadTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function createImportProcess(ImportProcessPayloadTransfer $importProcessPayloadTransfer): ImportProcessTransfer
    {
        return $this->getFactory()->createImportProcessCreator()->createImportProcess($importProcessPayloadTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $importProcessIds
     *
     * @return void
     */
    public function runImportProcesses(array $importProcessIds): void
    {
        $this->getFactory()->createImportProcessRunner()->run($importProcessIds);
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
        return $this->getRepository()->findImportProcessById($idImportProcess);
    }
}
