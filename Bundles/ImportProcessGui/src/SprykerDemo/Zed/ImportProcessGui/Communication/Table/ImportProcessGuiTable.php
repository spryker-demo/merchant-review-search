<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGui\Communication\Table;

use Orm\Zed\ImportProcess\Persistence\Map\SpyImportProcessTableMap;
use Orm\Zed\ImportProcess\Persistence\SpyImportProcess;
use Orm\Zed\ImportProcess\Persistence\SpyImportProcessQuery;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Acl\Business\AclFacadeInterface;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use SprykerDemo\Zed\ImportProcessGui\ImportProcessGuiConfig;

class ImportProcessGuiTable extends AbstractTable
{
    /**
     * @var string
     */
    protected const ACTIONS = 'actions';

    /**
     * @var string
     */
    protected const COL_ID = SpyImportProcessTableMap::COL_ID_IMPORT_PROCESS;

    /**
     * @var string
     */
    protected const COL_STATUS = SpyImportProcessTableMap::COL_STATUS;

    /**
     * @var string
     */
    protected const COL_CREATED_AT = SpyImportProcessTableMap::COL_CREATED_AT;

    /**
     * @var \Orm\Zed\ImportProcess\Persistence\SpyImportProcessQuery
     */
    protected $importProcessQuery;

    /**
     * @var \Spryker\Zed\Acl\Business\AclFacadeInterface
     */
    protected $aclFacade;

    /**
     * @param \Orm\Zed\ImportProcess\Persistence\SpyImportProcessQuery $importProcessQuery
     * @param \Spryker\Zed\Acl\Business\AclFacadeInterface $aclFacade
     */
    public function __construct(SpyImportProcessQuery $importProcessQuery, AclFacadeInterface $aclFacade)
    {
        $this->importProcessQuery = $importProcessQuery;
        $this->aclFacade = $aclFacade;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader([
            static::COL_ID => '#',
            static::COL_STATUS => 'Status',
            static::COL_CREATED_AT => 'Created at',
            static::ACTIONS => static::ACTIONS,
        ]);

        $config->addRawColumn(static::ACTIONS);
        $config->addRawColumn(static::COL_STATUS);

        $config->setSortable([
            static::COL_ID,
            static::COL_STATUS,
            static::COL_CREATED_AT,
        ]);

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array<mixed>
     */
    protected function prepareData(TableConfiguration $config): array
    {
        $this->importProcessQuery->where(SpyImportProcessTableMap::COL_FK_USER . '=?', $this->aclFacade->getCurrentUser()->getIdUser());
        $result = [];

        /** @var array<\Orm\Zed\ImportProcess\Persistence\SpyImportProcess> $queryResult */
        $queryResult = $this->runQuery($this->importProcessQuery, $config, true);

        foreach ($queryResult as $importProcessEntity) {
            $result[] = [
                static::COL_ID => $importProcessEntity->getIdImportProcess(),
                static::COL_STATUS => $importProcessEntity->getStatus() !== null
                    ? $this->createStatusLabel($importProcessEntity->getStatus())
                    : '',
                static::COL_CREATED_AT => $importProcessEntity->getCreatedAt() !== null
                    ? $importProcessEntity->getCreatedAt()->format('Y-m-d H:i:s')
                    : '',
                static::ACTIONS => $this->getActionButtons($importProcessEntity),
            ];
        }

        return $result;
    }

    /**
     * @param \Orm\Zed\ImportProcess\Persistence\SpyImportProcess $importProcessEntity
     *
     * @return string
     */
    protected function getActionButtons(SpyImportProcess $importProcessEntity): string
    {
        return $this->generateEditButton(
            Url::generate('/import-process-gui/index/view', ['id-process' => $importProcessEntity->getIdImportProcess()]),
            'View',
        );
    }

    /**
     * @param string $currentStatus
     *
     * @return string
     */
    protected function createStatusLabel(string $currentStatus): string
    {
        return $this->generateLabel(ucwords($currentStatus), ImportProcessGuiConfig::STATUS_CLASS_LABEL_MAPPING[$currentStatus]);
    }
}
