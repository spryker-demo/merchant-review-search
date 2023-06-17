<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Service\GoogleSpreadsheets;

use Spryker\Service\Kernel\AbstractService;

/**
 * @method \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceFactory getFactory()
 */
class GoogleSpreadsheetsService extends AbstractService implements GoogleSpreadsheetsServiceInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $spreadsheetId
     *
     * @return array
     */
    public function getSheetNames(string $spreadsheetId): array
    {
        return $this->getFactory()->createSpreadsheetReader()->getSheetNames($spreadsheetId);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $spreadsheetId
     * @param string $sheetName
     *
     * @return array
     */
    public function getSheetContent(string $spreadsheetId, string $sheetName): array
    {
        return $this->getFactory()->createSpreadsheetReader()->getSheetContent($spreadsheetId, $sheetName);
    }
}
