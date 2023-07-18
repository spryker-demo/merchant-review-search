<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\Form\DataProvider;

use Google\Service\Exception;
use SprykerDemo\Service\GoogleSheets\GoogleSheetsServiceInterface;
use SprykerDemo\Zed\ImportProcessGoogleSheets\Business\ImportProcessGoogleSheetsFacadeInterface;
use SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\Exception\SpreadsheetAccessDeniedException;
use SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\Form\ImportSheetForm;

class ImportSheetFormDataProvider
{
    /**
     * @var int
     */
    protected const CODE_HTTP_UNAUTHORIZED = 403;

    /**
     * @var \SprykerDemo\Service\GoogleSheets\GoogleSheetsServiceInterface
     */
    protected GoogleSheetsServiceInterface $googleSheetsService;

    /**
     * @var \SprykerDemo\Zed\ImportProcessGoogleSheets\Business\ImportProcessGoogleSheetsFacadeInterface
     */
    protected ImportProcessGoogleSheetsFacadeInterface $importProcessGoogleSheetsFacade;

    /**
     * @param \SprykerDemo\Service\GoogleSheets\GoogleSheetsServiceInterface $googleSheetsService
     * @param \SprykerDemo\Zed\ImportProcessGoogleSheets\Business\ImportProcessGoogleSheetsFacadeInterface $importProcessGoogleSheetsFacade
     */
    public function __construct(
        GoogleSheetsServiceInterface $googleSheetsService,
        ImportProcessGoogleSheetsFacadeInterface $importProcessGoogleSheetsFacade
    ) {
        $this->googleSheetsService = $googleSheetsService;
        $this->importProcessGoogleSheetsFacade = $importProcessGoogleSheetsFacade;
    }

    /**
     * @param string $spreadsheetUrl
     *
     * @return array<string, mixed>
     */
    public function getOptions(string $spreadsheetUrl): array
    {
        return [
            ImportSheetForm::OPTION_IMPORT_TYPES => $this->getApplicableImportTypes($spreadsheetUrl),
        ];
    }

    /**
     * @param string $spreadsheetUrl
     *
     * @throws \SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\Exception\SpreadsheetAccessDeniedException
     *
     * @return array<string, string>
     */
    protected function getApplicableImportTypes(string $spreadsheetUrl): array
    {
        try {
            $sheetNames = $this->googleSheetsService->getSheetNames($spreadsheetUrl);
        } catch (Exception $e) {
            if ($e->getCode() === static::CODE_HTTP_UNAUTHORIZED) {
                throw new SpreadsheetAccessDeniedException(
                    $e->getMessage(),
                );
            }

            throw $e;
        }

        $importTypes = $this->getAllowedSheetNames($sheetNames);

        return array_combine($importTypes, $importTypes);
    }

    /**
     * @param array<string> $sheetNames
     *
     * @return array<string>
     */
    protected function getAllowedSheetNames(array $sheetNames): array
    {
        return array_intersect(
            $this->importProcessGoogleSheetsFacade->getAllowedSheetNames(),
            $sheetNames,
        );
    }
}
