<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Service\GoogleSheets;

use Spryker\Service\Kernel\AbstractService;

/**
 * @method \SprykerDemo\Service\GoogleSheets\GoogleSheetsServiceFactory getFactory()
 */
class GoogleSheetsService extends AbstractService implements GoogleSheetsServiceInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $spreadsheetId
     *
     * @return array<string>
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
     * @param string $range
     *
     * @return array<array<string>>
     */
    public function getSheetContent(string $spreadsheetId, string $range): array
    {
        return $this->getFactory()->createSpreadsheetReader()->getSheetContent($spreadsheetId, $range);
    }
}
