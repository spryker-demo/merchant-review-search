<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Business;

use Pyz\Zed\DataImport\Communication\Plugin\ImportProcess\DataImportByImportProcessPluginInterface;
use SprykerDemo\Zed\ImportProcess\Business\Executor\Executor;
use SprykerDemo\Zed\ImportProcess\Business\Executor\ExecutorInterface;
use SprykerDemo\Zed\ImportProcess\Business\Reader\Reader;
use SprykerDemo\Zed\ImportProcess\Business\Reader\ReaderInterface;
use SprykerDemo\Zed\ImportProcess\Business\Runner\Runner;
use SprykerDemo\Zed\ImportProcess\Business\Runner\RunnerInterface;
use SprykerDemo\Zed\ImportProcess\Business\Writer\Writer;
use SprykerDemo\Zed\ImportProcess\Business\Writer\WriterInterface;
use SprykerDemo\Zed\ImportProcess\ImportProcessDependencyProvider;
use Spryker\Service\Flysystem\FlysystemServiceInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface getEntityManager()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessRepositoryInterface getRepository()
 * @method \SprykerDemo\Zed\ImportProcess\ImportProcessConfig getConfig()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessQueryContainer getQueryContainer()
 */
class ImportProcessBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerDemo\Zed\ImportProcess\Business\Reader\ReaderInterface
     */
    public function createReader(): ReaderInterface
    {
        return new Reader($this->getRepository());
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcess\Business\Writer\WriterInterface
     */
    public function createWriter(): WriterInterface
    {
        return new Writer($this->getEntityManager());
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcess\Business\Executor\ExecutorInterface
     */
    public function createExecutor(): ExecutorInterface
    {
        return new Executor(
            $this->getDataImportByImportProcessPlugin(),
            $this->createReader(),
            $this->createWriter(),
            $this->getFlysystemService()
        );
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcess\Business\Runner\RunnerInterface
     */
    public function createRunner(): RunnerInterface
    {
        return new Runner();
    }

    /**
     * @return \Spryker\Service\Flysystem\FlysystemServiceInterface
     */
    public function getFlysystemService(): FlysystemServiceInterface
    {
        return $this->getProvidedDependency(ImportProcessDependencyProvider::SERVICE_FLYSYSTEM);
    }

    /**
     * @return \Pyz\Zed\DataImport\Communication\Plugin\ImportProcess\DataImportByImportProcessPlugin
     */
    public function getDataImportByImportProcessPlugin(): DataImportByImportProcessPluginInterface
    {
        return $this->getProvidedDependency(ImportProcessDependencyProvider::PLUGIN_DATA_IMPORT_BY_IMPORT_PROCESS);
    }
}
