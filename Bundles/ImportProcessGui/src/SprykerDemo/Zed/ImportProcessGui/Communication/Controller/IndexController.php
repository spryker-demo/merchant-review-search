<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use SprykerDemo\Zed\ImportProcessGui\ImportProcessGuiConfig;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerDemo\Zed\ImportProcessGui\Communication\ImportProcessGuiCommunicationFactory getFactory()
 * @method \SprykerDemo\Zed\ImportProcessGui\ImportProcessGuiConfig getConfig()
 */
class IndexController extends AbstractController
{
    /**
     * @var string
     */
    protected const PARAM_ID_PROCESS = 'id-process';

    /**
     * @var string
     */
    protected const MESSAGE_IMPORT_PROCESS_NOT_FOUND = 'Import process with id#%d not found.';

    /**
     * @var string
     */
    protected const REDIRECT_URL = '/import-process-gui/index';

    /**
     * @return array<string, mixed>
     */
    public function indexAction(): array
    {
        $table = $this->getFactory()
            ->createImportProcessGuiTable();

        return $this->viewResponse([
            'table' => $table->render(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function tableAction(): JsonResponse
    {
        $table = $this->getFactory()
            ->createImportProcessGuiTable();

        return $this->jsonResponse($table->fetchData());
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array<string, mixed>
     */
    public function viewAction(Request $request): array
    {
        $idImportProcess = $this->castId($request->query->get(static::PARAM_ID_PROCESS));

        $importProcessTransfer = $this->getFactory()
            ->getImportProcessFacade()
            ->findImportProcessById($idImportProcess);

        return $this->viewResponse([
            'idImportProcess' => $idImportProcess,
            'importProcess' => $importProcessTransfer,
            'labelClass' => $importProcessTransfer ? ImportProcessGuiConfig::STATUS_CLASS_LABEL_MAPPING[$importProcessTransfer->getStatus()] : '',
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array<string, mixed>
     */
    public function viewStatusAction(Request $request)
    {
        $importProcessId = $this->castId($request->query->get(static::PARAM_ID_PROCESS));

        $importProcessTransfer = $this->getFactory()
            ->getImportProcessFacade()
            ->findImportProcessById($importProcessId);

        if ($importProcessTransfer === null) {
            $this->addErrorMessage(sprintf(static::MESSAGE_IMPORT_PROCESS_NOT_FOUND, $importProcessId));

            return $this->redirectResponse(static::REDIRECT_URL);
        }

        return $this->viewResponse([
            'importProcess' => $importProcessTransfer,
            'labelClass' => ImportProcessGuiConfig::STATUS_CLASS_LABEL_MAPPING[$importProcessTransfer->getStatus()],
        ]);
    }
}
