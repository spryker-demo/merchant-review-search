<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheetGui\Communication\Form\DataProvider;

use Google\Service\Exception;
use SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceInterface;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\ImportProcessSpreadsheetFacadeInterface;
use SprykerDemo\Zed\ImportProcessSpreadsheetGui\Communication\Exception\SpreadsheetAccessDeniedException;
use SprykerDemo\Zed\ImportProcessSpreadsheetGui\Communication\Form\ImportSheetForm;

class ImportSheetFormDataProvider
{
    /**
     * @var int
     */
    protected const CODE_HTTP_UNAUTHORIZED = 403;

    /**
     * @var \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceInterface
     */
    protected GoogleSpreadsheetsServiceInterface $googleSpreadsheetsService;

    /**
     * @var \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\ImportProcessSpreadsheetFacadeInterface
     */
    protected ImportProcessSpreadsheetFacadeInterface $importProcessSpreadsheetFacade;

    /**
     * @param \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceInterface $googleSpreadsheetsService
     * @param \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\ImportProcessSpreadsheetFacadeInterface $importProcessSpreadsheetFacade
     */
    public function __construct(
        GoogleSpreadsheetsServiceInterface $googleSpreadsheetsService,
        ImportProcessSpreadsheetFacadeInterface $importProcessSpreadsheetFacade
    ) {
        $this->googleSpreadsheetsService = $googleSpreadsheetsService;
        $this->importProcessSpreadsheetFacade = $importProcessSpreadsheetFacade;
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
     * @throws \SprykerDemo\Zed\ImportProcessSpreadsheetGui\Communication\Exception\SpreadsheetAccessDeniedException
     *
     * @return array<string, string>
     */
    protected function getApplicableImportTypes(string $spreadsheetUrl): array
    {
        try {
            $sheetNames = $this->googleSpreadsheetsService->getSheetNames($spreadsheetUrl);
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
            $this->importProcessSpreadsheetFacade->getAllowedSheetNames(),
            $sheetNames,
        );
    }
}
