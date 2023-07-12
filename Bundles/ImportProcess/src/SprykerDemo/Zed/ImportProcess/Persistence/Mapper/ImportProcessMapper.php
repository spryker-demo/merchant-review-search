<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Persistence\Mapper;

use Generated\Shared\Transfer\ImportProcessPayloadTransfer;
use Generated\Shared\Transfer\ImportProcessReportTransfer;
use Generated\Shared\Transfer\ImportProcessTransfer;
use Orm\Zed\ImportProcess\Persistence\SpyImportProcess;

class ImportProcessMapper
{
    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     * @param \Orm\Zed\ImportProcess\Persistence\SpyImportProcess $importProcessEntity
     *
     * @return \Orm\Zed\ImportProcess\Persistence\SpyImportProcess
     */
    public function mapImportProcessTransferToImportProcessEntity(
        ImportProcessTransfer $importProcessTransfer,
        SpyImportProcess $importProcessEntity
    ): SpyImportProcess {
        if ($importProcessTransfer->getIdImportProcess() !== null) {
            $importProcessEntity->setIdImportProcess($importProcessTransfer->getIdImportProcess());
        }

        $importProcessEntity->setFkUser($importProcessTransfer->getFkUserOrFail());
        $importProcessEntity->setType($importProcessTransfer->getTypeOrFail());
        $importProcessEntity->setStatus($importProcessTransfer->getStatusOrFail());
        $importProcessEntity->setImportMap($importProcessTransfer->getPayloadOrFail()->serialize());
        $importProcessEntity->setImportReport(
            $importProcessTransfer->getImportReport()
                ? $importProcessTransfer->getImportReport()->serialize()
                : null,
        );

        return $importProcessEntity;
    }

    /**
     * @param \Orm\Zed\ImportProcess\Persistence\SpyImportProcess $importProcessEntity
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function mapImportProcessEntityToImportProcessTransfer(
        SpyImportProcess $importProcessEntity,
        ImportProcessTransfer $importProcessTransfer
    ): ImportProcessTransfer {
        $importProcessTransfer->setIdImportProcess($importProcessEntity->getIdImportProcess());
        $importProcessTransfer->setFkUser($importProcessEntity->getFkUser());
        $importProcessTransfer->setType($importProcessEntity->getType());
        $importProcessTransfer->setStatus($importProcessEntity->getStatus());
        $importProcessTransfer->setCreatedAt(
            $importProcessEntity->getCreatedAt()
                ? $importProcessEntity->getCreatedAt()->format('Y-m-d H:i:s')
                : $importProcessEntity->getCreatedAt(),
        );
        $importProcessTransfer->setUpdatedAt(
            $importProcessEntity->getUpdatedAt()
                ? $importProcessEntity->getUpdatedAt()->format('Y-m-d H:i:s')
                : $importProcessEntity->getUpdatedAt(),
        );

        $importProcessPayloadTransfer = new ImportProcessPayloadTransfer();
        $importProcessPayloadTransfer->unserialize($importProcessEntity->getImportMap() ?? '[]');
        $importProcessTransfer->setPayload($importProcessPayloadTransfer);

        if ($importProcessEntity->getImportReport() !== null) {
            $reportTransfer = new ImportProcessReportTransfer();
            $reportTransfer->unserialize($importProcessEntity->getImportReport());
            $importProcessTransfer->setImportReport($reportTransfer);
        }

        return $importProcessTransfer;
    }
}
