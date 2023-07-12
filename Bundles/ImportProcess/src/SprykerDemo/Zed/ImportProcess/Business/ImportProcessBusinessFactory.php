<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Business;

use Spryker\Zed\Acl\Business\AclFacadeInterface;
use Spryker\Zed\DataImport\Business\DataImportFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessCreator;
use SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessCreatorInterface;
use SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessDataImportExecutor;
use SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessDataImportExecutorInterface;
use SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessReportAggregator;
use SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessReportAggregatorInterface;
use SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessRunner;
use SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessRunnerInterface;
use SprykerDemo\Zed\ImportProcess\ImportProcessDependencyProvider;

/**
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface getEntityManager()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessRepositoryInterface getRepository()
 * @method \SprykerDemo\Zed\ImportProcess\ImportProcessConfig getConfig()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessQueryContainerInterface getQueryContainer()
 */
class ImportProcessBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessCreatorInterface
     */
    public function createImportProcessCreator(): ImportProcessCreatorInterface
    {
        return new ImportProcessCreator(
            $this->getAclFacade(),
            $this->getEntityManager(),
        );
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessRunnerInterface
     */
    public function createImportProcessRunner(): ImportProcessRunnerInterface
    {
        return new ImportProcessRunner(
            $this->getRepository(),
            $this->getEntityManager(),
            $this->createImportProcessDataImportExecutor(),
            $this->getImportProcessPreExecutePlugins(),
            $this->getImportProcessPostExecutePlugins(),
        );
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessDataImportExecutorInterface
     */
    public function createImportProcessDataImportExecutor(): ImportProcessDataImportExecutorInterface
    {
        return new ImportProcessDataImportExecutor(
            $this->getDataImportFacade(),
            $this->createImportProcessReportAggregator(),
        );
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcess\Business\ImportProcess\ImportProcessReportAggregatorInterface
     */
    public function createImportProcessReportAggregator(): ImportProcessReportAggregatorInterface
    {
        return new ImportProcessReportAggregator();
    }

    /**
     * @return \Spryker\Zed\Acl\Business\AclFacadeInterface
     */
    public function getAclFacade(): AclFacadeInterface
    {
        return $this->getProvidedDependency(ImportProcessDependencyProvider::FACADE_ACL);
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\DataImportFacadeInterface
     */
    public function getDataImportFacade(): DataImportFacadeInterface
    {
        return $this->getProvidedDependency(ImportProcessDependencyProvider::FACADE_DATA_IMPORT);
    }

    /**
     * @return array<\SprykerDemo\Zed\ImportProcess\Dependency\Plugin\ImportProcessPreExecutePluginInterface>
     */
    public function getImportProcessPreExecutePlugins(): array
    {
        return $this->getProvidedDependency(ImportProcessDependencyProvider::PLUGINS_IMPORT_PROCESS_PRE_EXECUTE);
    }

    /**
     * @return array<\SprykerDemo\Zed\ImportProcess\Dependency\Plugin\ImportProcessPostExecutePluginInterface>
     */
    public function getImportProcessPostExecutePlugins(): array
    {
        return $this->getProvidedDependency(ImportProcessDependencyProvider::PLUGINS_IMPORT_PROCESS_POST_EXECUTE);
    }
}
