<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerDemo\Service\GoogleSheets\GoogleSheetsServiceInterface;
use SprykerDemo\Zed\ImportProcessGoogleSheets\Business\ImportProcessGoogleSheetsFacadeInterface;
use SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\Form\DataProvider\ImportSheetFormDataProvider;
use SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\Form\ImportSheetForm;
use SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\Form\SelectSheetForm;
use SprykerDemo\Zed\ImportProcessGoogleSheetsGui\ImportProcessGoogleSheetsGuiDependencyProvider;
use Symfony\Component\Form\FormInterface;

class ImportProcessGoogleSheetsGuiCommunicationFactory extends AbstractCommunicationFactory
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
     * @return \SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\Form\DataProvider\ImportSheetFormDataProvider
     */
    public function createImportSheetFormDataProvider(): ImportSheetFormDataProvider
    {
        return new ImportSheetFormDataProvider(
            $this->getGoogleSheetsService(),
            $this->getImportProcessGoogleSheetsFacade(),
        );
    }

    /**
     * @return \SprykerDemo\Zed\ImportProcessGoogleSheets\Business\ImportProcessGoogleSheetsFacadeInterface
     */
    public function getImportProcessGoogleSheetsFacade(): ImportProcessGoogleSheetsFacadeInterface
    {
        return $this->getProvidedDependency(ImportProcessGoogleSheetsGuiDependencyProvider::FACADE_IMPORT_PROCESS_GOOGLE_SHEETS);
    }

    /**
     * @return \SprykerDemo\Service\GoogleSheets\GoogleSheetsServiceInterface
     */
    public function getGoogleSheetsService(): GoogleSheetsServiceInterface
    {
        return $this->getProvidedDependency(ImportProcessGoogleSheetsGuiDependencyProvider::SERVICE_GOOGLE_SHEETS);
    }
}
