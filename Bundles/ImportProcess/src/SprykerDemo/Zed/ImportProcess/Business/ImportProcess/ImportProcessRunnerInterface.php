<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\ImportProcess;

interface ImportProcessRunnerInterface
{
    /**
     * @param array<int> $importProcessIds
     *
     * @return void
     */
    public function run(array $importProcessIds): void;
}
