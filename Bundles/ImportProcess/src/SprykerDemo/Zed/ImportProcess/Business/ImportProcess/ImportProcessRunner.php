<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\ImportProcess;

use Generated\Shared\Transfer\ImportProcessTransfer;
use Orm\Zed\ImportProcess\Persistence\Map\SpyImportProcessTableMap;
use SprykerDemo\Zed\ImportProcess\Business\Exception\ImportProcessNotFoundException;
use SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface;
use SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessRepositoryInterface;

class ImportProcessRunner implements ImportProcessRunnerInterface
{
    /**
     * @var \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessRepositoryInterface
     */
    protected ImportProcessRepositoryInterface $importProcessRepository;

    /**
     * @var \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface
     */
    protected ImportProcessEntityManagerInterface $importProcessEntityManager;

    /**
     * @var \SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessDataImportExecutorInterface
     */
    protected ImportProcessDataImportExecutorInterface $dataImportExecutor;

    /**
     * @var array<\SprykerDemo\Zed\ImportProcess\Dependency\Plugin\ImportProcessPreExecutePluginInterface>
     */
    protected array $preExecutePlugins;

    /**
     * @var array<\SprykerDemo\Zed\ImportProcess\Dependency\Plugin\ImportProcessPostExecutePluginInterface>
     */
    protected array $postExecutePlugins;

    /**
     * @param \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessRepositoryInterface $importProcessRepository
     * @param \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface $importProcessEntityManager
     * @param \SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessDataImportExecutorInterface $dataImportExecutor
     * @param array<\SprykerDemo\Zed\ImportProcess\Dependency\Plugin\ImportProcessPreExecutePluginInterface> $preExecutePlugins
     * @param array<\SprykerDemo\Zed\ImportProcess\Dependency\Plugin\ImportProcessPostExecutePluginInterface> $postExecutePlugins
     */
    public function __construct(
        ImportProcessRepositoryInterface $importProcessRepository,
        ImportProcessEntityManagerInterface $importProcessEntityManager,
        ImportProcessDataImportExecutorInterface $dataImportExecutor,
        array $preExecutePlugins,
        array $postExecutePlugins
    ) {
        $this->importProcessRepository = $importProcessRepository;
        $this->importProcessEntityManager = $importProcessEntityManager;
        $this->dataImportExecutor = $dataImportExecutor;
        $this->preExecutePlugins = $preExecutePlugins;
        $this->postExecutePlugins = $postExecutePlugins;
    }

    /**
     * @param array<int> $importProcessIds
     *
     * @return void
     */
    public function run(array $importProcessIds): void
    {
        foreach ($importProcessIds as $importProcessId) {
            $this->runImportProcessById($importProcessId);
        }
    }

    /**
     * @param int $importProcessId
     *
     * @return void
     */
    protected function runImportProcessById(int $importProcessId): void
    {
        $importProcessTransfer = $this->getImportProcess($importProcessId);

        $importProcessTransfer = $this->runPreExecutePlugins($importProcessTransfer);

        $importProcessReportTransfer = $this->dataImportExecutor->execute($importProcessTransfer);
        $importProcessTransfer->setImportReport($importProcessReportTransfer);
        $importProcessTransfer->setStatus(
            $importProcessReportTransfer->getIsSuccess()
                ? SpyImportProcessTableMap::COL_STATUS_FINISHED
                : SpyImportProcessTableMap::COL_STATUS_FAILED,
        );
        $this->importProcessEntityManager->saveImportProcessEntity($importProcessTransfer);

        $this->runPostExecutePlugins($importProcessTransfer);
    }

    /**
     * @param int $importProcessId
     *
     * @throws \SprykerDemo\Zed\ImportProcess\Business\Exception\ImportProcessNotFoundException
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    protected function getImportProcess(int $importProcessId): ImportProcessTransfer
    {
        $importProcessTransfer = $this->importProcessRepository
            ->findImportProcessById($importProcessId);

        if ($importProcessTransfer === null) {
            throw new ImportProcessNotFoundException('Import process not found');
        }

        return $importProcessTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    protected function runPreExecutePlugins(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer
    {
        foreach ($this->preExecutePlugins as $preExecutePlugin) {
            $importProcessTransfer = $preExecutePlugin->preExecute($importProcessTransfer);
        }

        return $importProcessTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    protected function runPostExecutePlugins(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer
    {
        foreach ($this->postExecutePlugins as $postExecutePlugin) {
            $importProcessTransfer = $postExecutePlugin->postExecute($importProcessTransfer);
        }

        return $importProcessTransfer;
    }
}
