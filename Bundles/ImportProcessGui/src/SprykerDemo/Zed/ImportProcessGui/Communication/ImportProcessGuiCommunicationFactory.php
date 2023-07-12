<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGui\Communication;

use Orm\Zed\ImportProcess\Persistence\SpyImportProcessQuery;
use Spryker\Zed\Acl\Business\AclFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerDemo\Zed\ImportProcess\Business\ImportProcessFacadeInterface;
use SprykerDemo\Zed\ImportProcessGui\Communication\Table\ImportProcessGuiTable;
use SprykerDemo\Zed\ImportProcessGui\ImportProcessGuiDependencyProvider;

/**
 * @method \SprykerDemo\Zed\ImportProcessGui\ImportProcessGuiConfig getConfig()
 */
class ImportProcessGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \SprykerDemo\Zed\ImportProcessGui\Communication\Table\ImportProcessGuiTable
     */
    public function createTable(): ImportProcessGuiTable
    {
        return new ImportProcessGuiTable(
            $this->getImportProcessQuery(),
            $this->getAclFacade(),
        );
    }

    /**
     * @return \Orm\Zed\ImportProcess\Persistence\SpyImportProcessQuery
     */
    protected function getImportProcessQuery(): SpyImportProcessQuery
    {
        return SpyImportProcessQuery::create();
    }

    /**
     * @return \Spryker\Zed\Acl\Business\AclFacadeInterface
     */
    public function getAclFacade(): AclFacadeInterface
    {
        return $this->getProvidedDependency(ImportProcessGuiDependencyProvider::FACADE_ACL);
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcess\Business\ImportProcessFacadeInterface
     */
    public function getImportProcessFacade(): ImportProcessFacadeInterface
    {
        return $this->getProvidedDependency(ImportProcessGuiDependencyProvider::FACADE_PRODUCT_IMPORT_PROCESS);
    }
}
