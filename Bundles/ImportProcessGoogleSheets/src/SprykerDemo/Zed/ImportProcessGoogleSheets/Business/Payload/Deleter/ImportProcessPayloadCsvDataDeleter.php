<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGoogleSheets\Business\Payload\Deleter;

use Generated\Shared\Transfer\ImportProcessTransfer;

class ImportProcessPayloadCsvDataDeleter implements ImportProcessPayloadDataDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function deletePayloadData(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer
    {
        foreach ($importProcessTransfer->getPayloadOrFail()->getSourceMaps() as $sourceMapTransfer) {
            $filePath = $sourceMapTransfer->getSource();

            if ($filePath !== null && file_exists($filePath)) {
                unlink($filePath);
            }
        }

        return $importProcessTransfer;
    }
}
