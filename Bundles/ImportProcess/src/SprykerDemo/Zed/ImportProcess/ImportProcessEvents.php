<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess;

interface ImportProcessEvents
{
    /**
     * Specification:
     * - This events will be used for spy_import_process entity creation
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_IMPORT_PROCESS_CREATE = 'Entity.spy_import_process.create';
}
