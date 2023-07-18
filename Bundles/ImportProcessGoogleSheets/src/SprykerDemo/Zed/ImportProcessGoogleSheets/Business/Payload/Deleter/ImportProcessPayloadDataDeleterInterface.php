<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGoogleSheets\Business\Payload\Deleter;

use Generated\Shared\Transfer\ImportProcessTransfer;

interface ImportProcessPayloadDataDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function deletePayloadData(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer;
}
