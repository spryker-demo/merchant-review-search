<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Persistence;

use Generated\Shared\Transfer\ImportProcessTransfer;

interface ImportProcessEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function saveImportProcessEntity(
        ImportProcessTransfer $importProcessTransfer
    ): ImportProcessTransfer;
}
