<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\Controller;

use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\BundleConfigResolverAwareTrait;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\Exception\SpreadsheetAccessDeniedException;
use SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\Form\ImportSheetForm;
use SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\Form\SelectSheetForm;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\ImportProcessGoogleSheetsGuiCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    use BundleConfigResolverAwareTrait;

    /**
     * @var string
     */
    protected const SPREADSHEET_ACCESS_DENIED_ERROR_MESSAGE = 'Access denied to the provided spreadsheet. Please grant access by link to the provided spreadsheet.';

    /**
     * @var string
     */
    protected const PARAM_ID_PROCESS = 'id-process';

    /**
     * @var string
     */
    protected const PARAM_SHEET_URL = 'sheet-url';

    /**
     * @var string
     */
    protected const URL_IMPORT_PROCESS_GUI_VIEW = '/import-process-gui/index/view';

    /**
     * @var string
     */
    protected const URL_IMPORT_FORM_SHEET = '/import-process-google-sheets-gui/index/import-from-sheet';

    /**
     * @var string
     */
    protected const URL_SELECT_SHEET = '/import-process-google-sheets-gui/index/select-sheet';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array<string, mixed>
     */
    public function selectSheetAction(Request $request)
    {
        $form = $this->getFactory()->getSelectSheetForm();
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->viewResponse([
                'form' => $form->createView(),
            ]);
        }

        return $this->redirectResponse(
            Url::generate(
                static::URL_IMPORT_FORM_SHEET,
                [
                    static::PARAM_SHEET_URL => $form->getData()[SelectSheetForm::FIELD_SHEET_URL],
                ],
            )->build(),
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array<string, mixed>
     */
    public function importFromSheetAction(Request $request)
    {
        $spreadsheetUrl = (string)$request->query->get(static::PARAM_SHEET_URL);

        try {
            $form = $this->getFactory()->getImportSheetForm($spreadsheetUrl);
        } catch (SpreadsheetAccessDeniedException $e) {
            $this->addErrorMessage(static::SPREADSHEET_ACCESS_DENIED_ERROR_MESSAGE);

            return $this->redirectResponse(Url::generate(static::URL_SELECT_SHEET)->build());
        }
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->viewResponse([
                'form' => $form->createView(),
            ]);
        }

        $importProcessTransfer = $this->getFactory()
            ->getImportProcessGoogleSheetsFacade()
            ->createImportProcess($spreadsheetUrl, $form->getData()[ImportSheetForm::FIELD_IMPORT_TYPES]);

        $this->addSuccessMessage('Import process started successfully.');

        return $this->redirectResponse(Url::generate(static::URL_IMPORT_PROCESS_GUI_VIEW, [
            static::PARAM_ID_PROCESS => $importProcessTransfer->getIdImportProcess(),
        ])->build());
    }
}
