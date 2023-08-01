<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess;

use Spryker\Shared\Event\EventConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ImportProcessConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @return string
     */
    public function getImportProcessQueueName(): string
    {
        return EventConstants::EVENT_QUEUE;
    }
}
