<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Deleter;

use Generated\Shared\Transfer\ImportProcessTransfer;

class ImportProcessAssetsDeleter
{
    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function deleteAssets(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer
    {
        foreach ($importProcessTransfer->getPayloadOrFail()->getSourceMaps() as $sourceMapTransfer) {
            if (file_exists($sourceMapTransfer->getSource())) {
                unlink($sourceMapTransfer->getSource());
            }
        }

        return $importProcessTransfer;
    }
}
