<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGoogleSheets\Business\ImportProcessCreator;

use Generated\Shared\Transfer\ImportProcessPayloadTransfer;
use Generated\Shared\Transfer\ImportProcessSourceMapTransfer;
use Generated\Shared\Transfer\ImportProcessTransfer;
use SprykerDemo\Zed\ImportProcess\Business\ImportProcessFacadeInterface;
use SprykerDemo\Zed\ImportProcessGoogleSheets\ImportProcessGoogleSheetsConfig;

class ImportProcessCreator implements ImportProcessCreatorInterface
{
    /**
     * @var \SprykerDemo\Zed\ImportProcess\Business\ImportProcessFacadeInterface
     */
    protected ImportProcessFacadeInterface $importProcessFacade;

    /**
     * @var \SprykerDemo\Zed\ImportProcessGoogleSheets\ImportProcessGoogleSheetsConfig
     */
    protected ImportProcessGoogleSheetsConfig $config;

    /**
     * @param \SprykerDemo\Zed\ImportProcess\Business\ImportProcessFacadeInterface $importProcessFacade
     * @param \SprykerDemo\Zed\ImportProcessGoogleSheets\ImportProcessGoogleSheetsConfig $config
     */
    public function __construct(
        ImportProcessFacadeInterface $importProcessFacade,
        ImportProcessGoogleSheetsConfig $config
    ) {
        $this->importProcessFacade = $importProcessFacade;
        $this->config = $config;
    }

    /**
     * @param string $spreadsheetUrl
     * @param array<string> $sheetNames
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function createImportProcess(string $spreadsheetUrl, array $sheetNames): ImportProcessTransfer
    {
        $allowedImportTypes = $this->filterAllowedSheetNames($sheetNames);
        $importProcessPayloadTransfer = new ImportProcessPayloadTransfer();
        $importProcessPayloadTransfer->setType($this->config->getSourceType());

        foreach ($allowedImportTypes as $importType) {
            $sourceMapTransfer = (new ImportProcessSourceMapTransfer())->setSource($spreadsheetUrl)
                ->setImportType($importType);
            $importProcessPayloadTransfer->addSourceMap($sourceMapTransfer);
        }

        return $this->importProcessFacade->createImportProcess($importProcessPayloadTransfer);
    }

    /**
     * @param array<string> $sheetNames
     *
     * @return array<string>
     */
    protected function filterAllowedSheetNames(array $sheetNames): array
    {
        return array_intersect($this->config->getAllowedImportTypes(), $sheetNames);
    }
}
