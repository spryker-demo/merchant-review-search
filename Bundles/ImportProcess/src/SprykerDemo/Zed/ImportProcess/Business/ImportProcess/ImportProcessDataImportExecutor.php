<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\ImportProcess;

use Generated\Shared\Transfer\DataImportConfigurationActionTransfer;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReaderConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Generated\Shared\Transfer\ImportProcessReportTransfer;
use Generated\Shared\Transfer\ImportProcessSourceMapTransfer;
use Generated\Shared\Transfer\ImportProcessTransfer;
use Spryker\Zed\DataImport\Business\DataImportFacadeInterface;

class ImportProcessDataImportExecutor implements ImportProcessDataImportExecutorInterface
{
    /**
     * @var string
     *
     * @uses \Spryker\Zed\DataImport\DataImportConfig::IMPORT_GROUP_FULL
     */
    protected const IMPORT_GROUP = 'FULL';

    /**
     * @var \Spryker\Zed\DataImport\Business\DataImportFacadeInterface
     */
    protected DataImportFacadeInterface $dataImportFacade;

    /**
     * @var \SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessReportAggregatorInterface
     */
    protected ImportProcessReportAggregatorInterface $importProcessReportAggregator;

    /**
     * @param \Spryker\Zed\DataImport\Business\DataImportFacadeInterface $dataImportFacade
     * @param \SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessReportAggregatorInterface $importProcessReportAggregator
     */
    public function __construct(
        DataImportFacadeInterface $dataImportFacade,
        ImportProcessReportAggregatorInterface $importProcessReportAggregator
    ) {
        $this->dataImportFacade = $dataImportFacade;
        $this->importProcessReportAggregator = $importProcessReportAggregator;
    }

    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessReportTransfer
     */
    public function execute(ImportProcessTransfer $importProcessTransfer): ImportProcessReportTransfer
    {
        $dataImporterReportCollection = [];

        foreach ($importProcessTransfer->getPayloadOrFail()->getSourceMaps() as $sourceMapTransfer) {
            $dataImportConfigurationActionTransfer = (new DataImportConfigurationActionTransfer())->setSource($sourceMapTransfer->getSource())
                ->setDataEntity($sourceMapTransfer->getImportType());
            $dataImporterConfigurationTransfer = $this->buildDataImporterConfiguration($sourceMapTransfer);
            $dataImporterReportTransfer = $this->dataImportFacade->importByAction($dataImportConfigurationActionTransfer, $dataImporterConfigurationTransfer);
            $dataImporterReportCollection = $this->collectDataImporterReport($dataImporterReportTransfer, $dataImporterReportCollection);
        }

        return $this->importProcessReportAggregator->aggregateReports($dataImporterReportCollection);
    }

    /**
     * @param \Generated\Shared\Transfer\ImportProcessSourceMapTransfer $sourceMapTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    protected function buildDataImporterConfiguration(ImportProcessSourceMapTransfer $sourceMapTransfer): DataImporterConfigurationTransfer
    {
        $dataImporterReaderConfigurationTransfer = (new DataImporterReaderConfigurationTransfer())->setFileName(
            $sourceMapTransfer->getSource(),
        );

        return (new DataImporterConfigurationTransfer())->setImportType($sourceMapTransfer->getImportType())
            ->setImportGroup(static::IMPORT_GROUP)
            ->setReaderConfiguration($dataImporterReaderConfigurationTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\DataImporterReportTransfer $dataImporterReportTransfer
     * @param array<\Generated\Shared\Transfer\DataImporterReportTransfer> $dataImporterReportsCollection
     *
     * @return array<\Generated\Shared\Transfer\DataImporterReportTransfer>
     */
    protected function collectDataImporterReport(
        DataImporterReportTransfer $dataImporterReportTransfer,
        array $dataImporterReportsCollection
    ): array {
        if (count($dataImporterReportTransfer->getDataImporterReports())) {
            foreach ($dataImporterReportTransfer->getDataImporterReports() as $subDataImporterReportTransfer) {
                $dataImporterReportsCollection[] = $subDataImporterReportTransfer;
            }

            return $dataImporterReportsCollection;
        }

        $dataImporterReportsCollection[] = $dataImporterReportTransfer;

        return $dataImporterReportsCollection;
    }
}
