<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\ImportProcess;

use Generated\Shared\Transfer\ImportProcessPayloadTransfer;
use Generated\Shared\Transfer\ImportProcessTransfer;
use Orm\Zed\ImportProcess\Persistence\Map\SpyImportProcessTableMap;
use Spryker\Zed\Acl\Business\AclFacadeInterface;
use SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface;

class ImportProcessCreator implements ImportProcessCreatorInterface
{
    /**
     * @var \Spryker\Zed\Acl\Business\AclFacadeInterface
     */
    protected AclFacadeInterface $aclFacade;

    /**
     * @var \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface
     */
    protected ImportProcessEntityManagerInterface $importProcessEntityManager;

    /**
     * @param \Spryker\Zed\Acl\Business\AclFacadeInterface $aclFacade
     * @param \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface $importProcessEntityManager
     */
    public function __construct(AclFacadeInterface $aclFacade, ImportProcessEntityManagerInterface $importProcessEntityManager)
    {
        $this->aclFacade = $aclFacade;
        $this->importProcessEntityManager = $importProcessEntityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\ImportProcessPayloadTransfer $importProcessPayloadTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function createImportProcess(ImportProcessPayloadTransfer $importProcessPayloadTransfer): ImportProcessTransfer
    {
        return $this->importProcessEntityManager->saveImportProcessEntity(
            $this->createImportProcessTransfer($importProcessPayloadTransfer),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ImportProcessPayloadTransfer $importProcessPayloadTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    protected function createImportProcessTransfer(ImportProcessPayloadTransfer $importProcessPayloadTransfer): ImportProcessTransfer
    {
        return (new ImportProcessTransfer())
            ->setFkUser($this->aclFacade->getCurrentUser()->getIdUser())
            ->setPayload($importProcessPayloadTransfer)
            ->setType($importProcessPayloadTransfer->getType())
            ->setStatus(SpyImportProcessTableMap::COL_STATUS_CREATED);
    }
}
