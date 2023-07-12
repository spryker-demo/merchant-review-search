<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheetGui\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceInterface;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Business\ImportProcessSpreadsheetFacadeInterface;
use SprykerDemo\Zed\ImportProcessSpreadsheetGui\Communication\Form\DataProvider\ImportSheetFormDataProvider;
use SprykerDemo\Zed\ImportProcessSpreadsheetGui\Communication\Form\ImportSheetForm;
use SprykerDemo\Zed\ImportProcessSpreadsheetGui\Communication\Form\SelectSheetForm;
use SprykerDemo\Zed\ImportProcessSpreadsheetGui\ImportProcessSpreadsheetGuiDependencyProvider;
use Symfony\Component\Form\FormInterface;

class ImportProcessSpreadsheetGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getSelectSheetForm(): FormInterface
    {
        return $this->getFormFactory()->create(SelectSheetForm::class);
    }

    /**
     * @param string $spreadsheetUrl
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getImportSheetForm(string $spreadsheetUrl): FormInterface
    {
        $dataProvider = $this->createImportSheetFormDataProvider();

        return $this->getFormFactory()->create(ImportSheetForm::class, [], $dataProvider->getOptions($spreadsheetUrl));
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcessSpreadsheetGui\Communication\Form\DataProvider\ImportSheetFormDataProvider
     */
    public function createImportSheetFormDataProvider(): ImportSheetFormDataProvider
    {
        return new ImportSheetFormDataProvider(
            $this->getGoogleSpreadsheetsService(),
            $this->getImportProcessSpreadsheetFacade(),
        );
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcessSpreadsheet\Business\ImportProcessSpreadsheetFacadeInterface
     */
    public function getImportProcessSpreadsheetFacade(): ImportProcessSpreadsheetFacadeInterface
    {
        return $this->getProvidedDependency(ImportProcessSpreadsheetGuiDependencyProvider::FACADE_IMPORT_PROCESS_SPREADSHEET);
    }

    /**
     * @return \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceInterface
     */
    public function getGoogleSpreadsheetsService(): GoogleSpreadsheetsServiceInterface
    {
        return $this->getProvidedDependency(ImportProcessSpreadsheetGuiDependencyProvider::SERVICE_GOOGLE_SPREADSHEETS);
    }
}
