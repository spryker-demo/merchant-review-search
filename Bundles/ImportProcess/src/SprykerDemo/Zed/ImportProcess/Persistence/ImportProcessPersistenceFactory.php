<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Persistence;

use Orm\Zed\ImportProcess\Persistence\PyzImportProcessQuery;
use SprykerDemo\Zed\ImportProcess\Persistence\Mapper\ImportProcessMapper;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \SprykerDemo\Zed\ImportProcess\ImportProcessConfig getConfig()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessQueryContainer getQueryContainer()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessRepositoryInterface getRepository()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface getEntityManager()
 */
class ImportProcessPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ImportProcess\Persistence\PyzImportProcessQuery
     */
    public function createImportProcessQuery(): PyzImportProcessQuery
    {
        return PyzImportProcessQuery::create();
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcess\Persistence\Mapper\ImportProcessMapper
     */
    public function createImportProcessMapper(): ImportProcessMapper
    {
        return new ImportProcessMapper();
    }
}
