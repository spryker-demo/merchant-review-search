<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\Executor;

use Exception;
use Generated\Shared\Transfer\DataImporterCombinedReportTransfer;
use Orm\Zed\ImportProcess\Persistence\Map\PyzImportProcessTableMap;
use Pyz\Zed\DataImport\Communication\Plugin\ImportProcess\DataImportByImportProcessPluginInterface;
use SprykerDemo\Zed\ImportProcess\Business\Reader\ReaderInterface;
use SprykerDemo\Zed\ImportProcess\Business\Writer\WriterInterface;
use Spryker\Service\Flysystem\FlysystemServiceInterface;

class Executor implements ExecutorInterface
{
    protected DataImportByImportProcessPluginInterface $dataImportByImportProcessPlugin;

    protected ReaderInterface $reader;

    protected WriterInterface $writer;

    protected FlysystemServiceInterface $flysystemService;

    /**
     * @param \Pyz\Zed\DataImport\Communication\Plugin\ImportProcess\DataImportByImportProcessPluginInterface $dataImportByImportProcessPlugin
     * @param \SprykerDemo\Zed\ImportProcess\Business\Reader\ReaderInterface $reader
     * @param \SprykerDemo\Zed\ImportProcess\Business\Writer\WriterInterface $writer
     * @param \Spryker\Service\Flysystem\FlysystemServiceInterface $flysystemService
     */
    public function __construct(
        DataImportByImportProcessPluginInterface $dataImportByImportProcessPlugin,
        ReaderInterface $reader,
        WriterInterface $writer,
        FlysystemServiceInterface $flysystemService
    ) {
        $this->dataImportByImportProcessPlugin = $dataImportByImportProcessPlugin;
        $this->reader = $reader;
        $this->writer = $writer;
        $this->flysystemService = $flysystemService;
    }

    /**
     * @param int $idImportProcess
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\DataImporterCombinedReportTransfer
     */
    public function execute(int $idImportProcess): DataImporterCombinedReportTransfer
    {
        $importProcess = $this->reader->findImportProcessById($idImportProcess);
        if (!$importProcess) {
            throw new Exception('Import process not found by id: ' . $idImportProcess);
        }

        $dataImporterCombinedReportTransfer = $this->dataImportByImportProcessPlugin
            ->import($importProcess);

        $importProcess->setImportReport($dataImporterCombinedReportTransfer);

        foreach ($importProcess->getImportMap() as $fileName) {
            if ($this->flysystemService->has($importProcess->getFilesystem(), $fileName)) {
                $this->flysystemService->delete($importProcess->getFilesystem(), $fileName);
            }
        }

        if (!$dataImporterCombinedReportTransfer->getFailMessageCompiled()) {
            $importProcess->setStatus(PyzImportProcessTableMap::COL_STATUS_FINISHED);
        } else {
            $importProcess->setStatus(PyzImportProcessTableMap::COL_STATUS_FAILED);
        }

        $this->writer->saveImportProcess($importProcess);

        return $dataImporterCombinedReportTransfer;
    }
}
