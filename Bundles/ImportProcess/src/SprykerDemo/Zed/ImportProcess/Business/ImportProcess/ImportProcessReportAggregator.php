<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\ImportProcess;

use Generated\Shared\Transfer\ImportProcessReportTransfer;
use Generated\Shared\Transfer\ImportProcessSourceReportTransfer;

class ImportProcessReportAggregator implements ImportProcessReportAggregatorInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\DataImporterReportTransfer> $dataImporterReportTransfers
     *
     * @return \Generated\Shared\Transfer\ImportProcessReportTransfer
     */
    public function aggregateReports(array $dataImporterReportTransfers): ImportProcessReportTransfer
    {
        $importProcessReportTransfer = new ImportProcessReportTransfer();
        $importProcessSuccess = true;
        $totalImportedDataSetCount = 0;
        $totalImportTime = 0;

        foreach ($dataImporterReportTransfers as $dataImporterReportTransfer) {
            $sourceReport = (new ImportProcessSourceReportTransfer())->setIsSuccess($dataImporterReportTransfer->getIsSuccess())
                ->setImportType($dataImporterReportTransfer->getImportType())
                ->setImportTime($dataImporterReportTransfer->getImportTime())
                ->setImportedDataSetCount($dataImporterReportTransfer->getImportedDataSetCount())
                ->setExpectedImportableDataSetCount($dataImporterReportTransfer->getExpectedImportableDataSetCount());

            $importProcessSuccess = $importProcessSuccess && $dataImporterReportTransfer->getIsSuccess();
            $totalImportedDataSetCount += $dataImporterReportTransfer->getImportedDataSetCount();
            $totalImportTime += $dataImporterReportTransfer->getImportTime();
            $importProcessReportTransfer->addSourceReport($sourceReport);
        }

        $importProcessReportTransfer->setIsSuccess($importProcessSuccess);
        $importProcessReportTransfer->setImportedDataSetCount($totalImportedDataSetCount);
        $importProcessReportTransfer->setImportTime($totalImportTime);

        return $importProcessReportTransfer;
    }
}
