<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader;

use Generated\Shared\Transfer\ImportProcessTransfer;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetDownloader\AbstractSpreadsheetDownloader;

class ImportProcessAssetsDownloader implements ImportProcessAssetsDownloaderInterface
{
    /**
     * @var \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetDownloader\AbstractSpreadsheetDownloader
     */
    protected AbstractSpreadsheetDownloader $spreadsheetDownloader;

    /**
     * @param \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Assets\Downloader\SpreadsheetDownloader\AbstractSpreadsheetDownloader $spreadsheetDownloader
     */
    public function __construct(AbstractSpreadsheetDownloader $spreadsheetDownloader)
    {
        $this->spreadsheetDownloader = $spreadsheetDownloader;
    }

    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function downloadAssets(ImportProcessTransfer $importProcessTransfer): ImportProcessTransfer
    {
        foreach ($importProcessTransfer->getPayloadOrFail()->getSourceMaps() as $sourceMapTransfer) {
            $fileName = $this->spreadsheetDownloader->download(
                $sourceMapTransfer->getSource(),
                $sourceMapTransfer->getImportType(),
            );
            $sourceMapTransfer->setSource($fileName);
            $sourceMapTransfer->setImportType(
                $this->getImportTypeFromSheetName($sourceMapTransfer->getImportType()),
            );
        }

        return $importProcessTransfer;
    }

    /**
     * @param string $sheetName
     *
     * @return string
     */
    protected function getImportTypeFromSheetName(string $sheetName): string
    {
        return str_replace('_', '-', $sheetName);
    }
}
