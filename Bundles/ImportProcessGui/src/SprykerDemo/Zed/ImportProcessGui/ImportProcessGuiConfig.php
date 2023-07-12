<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGui;

use Orm\Zed\ImportProcess\Persistence\Map\SpyImportProcessTableMap;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ImportProcessGuiConfig extends AbstractBundleConfig
{
    /**
     * @var array<string, string>
     */
    public const STATUS_CLASS_LABEL_MAPPING = [
        SpyImportProcessTableMap::COL_STATUS_CREATED => 'label-warning',
        SpyImportProcessTableMap::COL_STATUS_FINISHED => 'label-success',
        SpyImportProcessTableMap::COL_STATUS_FAILED => 'label-danger',
    ];
}
