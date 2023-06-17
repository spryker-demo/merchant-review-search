<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Persistence\Mapper;

use Generated\Shared\Transfer\DataImporterCombinedReportTransfer;
use Generated\Shared\Transfer\ImportProcessTransfer;
use Orm\Zed\ImportProcess\Persistence\PyzImportProcess;

class ImportProcessMapper
{
    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     * @param \Orm\Zed\ImportProcess\Persistence\PyzImportProcess $importProcessEntity
     *
     * @return \Orm\Zed\ImportProcess\Persistence\PyzImportProcess
     */
    public function mapImportProcessTransferToImportProcessEntity(
        ImportProcessTransfer $importProcessTransfer,
        PyzImportProcess $importProcessEntity
    ): PyzImportProcess {
        $importProcessEntity->setIdImportProcess($importProcessTransfer->getIdImportProcess());
        $importProcessEntity->setFkUser($importProcessTransfer->getFkUser());
        $importProcessEntity->setFilesystem($importProcessTransfer->getFilesystem());
        $importProcessEntity->setStatus($importProcessTransfer->getStatus());
        $importProcessEntity->setImportMap(json_encode($importProcessTransfer->getImportMap(), JSON_THROW_ON_ERROR));
        if ($importProcessTransfer->getImportReport()) {
            $importProcessEntity->setImportReport($importProcessTransfer->getImportReport()->serialize());
        } else {
            $importProcessEntity->setImportReport(null);
        }

        return $importProcessEntity;
    }

    /**
     * @param \Orm\Zed\ImportProcess\Persistence\PyzImportProcess $importProcessEntity
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function mapImportProcessEntityToImportProcessTransfer(
        PyzImportProcess $importProcessEntity,
        ImportProcessTransfer $importProcessTransfer
    ): ImportProcessTransfer {
        $importProcessTransfer->setIdImportProcess($importProcessEntity->getIdImportProcess());
        $importProcessTransfer->setFkUser($importProcessEntity->getFkUser());
        $importProcessTransfer->setFilesystem($importProcessEntity->getFilesystem());
        $importProcessTransfer->setStatus($importProcessEntity->getStatus());
        $importProcessTransfer->setImportMap(json_decode($importProcessEntity->getImportMap() ?? '[]', true, 512, JSON_THROW_ON_ERROR));
        $importProcessTransfer->setCreatedAt($importProcessEntity->getCreatedAt() ? $importProcessEntity->getCreatedAt()->format('Y-m-d H:i:s') : $importProcessEntity->getCreatedAt());
        $importProcessTransfer->setUpdatedAt($importProcessEntity->getUpdatedAt() ? $importProcessEntity->getUpdatedAt()->format('Y-m-d H:i:s') : $importProcessEntity->getUpdatedAt());
        if ($importProcessEntity->getImportReport()) {
            $reportTransfer = new DataImporterCombinedReportTransfer();
            $reportTransfer->unserialize($importProcessEntity->getImportReport());
            $importProcessTransfer->setImportReport($reportTransfer);
        }

        return $importProcessTransfer;
    }
}
