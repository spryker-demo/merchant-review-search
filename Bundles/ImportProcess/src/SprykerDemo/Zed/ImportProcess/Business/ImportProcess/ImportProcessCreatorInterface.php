<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\ImportProcess;

use Generated\Shared\Transfer\ImportProcessPayloadTransfer;
use Generated\Shared\Transfer\ImportProcessTransfer;

interface ImportProcessCreatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ImportProcessPayloadTransfer $importProcessPayloadTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function createImportProcess(ImportProcessPayloadTransfer $importProcessPayloadTransfer): ImportProcessTransfer;
}
