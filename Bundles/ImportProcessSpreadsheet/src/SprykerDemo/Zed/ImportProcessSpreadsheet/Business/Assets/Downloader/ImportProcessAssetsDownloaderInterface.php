<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader;

use Generated\Shared\Transfer\ImportProcessTransfer;

interface ImportProcessAssetsDownloaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function downloadAssets(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer;
}
