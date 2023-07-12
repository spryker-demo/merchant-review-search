<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Persistence;

use Orm\Zed\ImportProcess\Persistence\SpyImportProcessQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerDemo\Zed\ImportProcess\Persistence\Mapper\ImportProcessMapper;

/**
 * @method \SprykerDemo\Zed\ImportProcess\ImportProcessConfig getConfig()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessQueryContainerInterface getQueryContainer()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessRepositoryInterface getRepository()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface getEntityManager()
 */
class ImportProcessPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ImportProcess\Persistence\SpyImportProcessQuery
     */
    public function createImportProcessQuery(): SpyImportProcessQuery
    {
        return SpyImportProcessQuery::create();
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcess\Persistence\Mapper\ImportProcessMapper
     */
    public function createImportProcessMapper(): ImportProcessMapper
    {
        return new ImportProcessMapper();
    }
}
