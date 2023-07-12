<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Service\GoogleSpreadsheets;

use Google_Client;
use Google_Service_Sheets;
use Spryker\Service\Kernel\AbstractServiceFactory;
use SprykerDemo\Service\GoogleSpreadsheets\SpreadsheetsReader\SpreadsheetsReader;
use SprykerDemo\Service\GoogleSpreadsheets\SpreadsheetsReader\SpreadsheetsReaderInterface;

/**
 * @method \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsConfig getConfig()
 */
class GoogleSpreadsheetsServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \SprykerDemo\Service\GoogleSpreadsheets\SpreadsheetsReader\SpreadsheetsReaderInterface
     */
    public function createSpreadsheetReader(): SpreadsheetsReaderInterface
    {
        return new SpreadsheetsReader(
            $this->createGoogleSheetsService(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Google_Service_Sheets
     */
    public function createGoogleSheetsService(): Google_Service_Sheets
    {
        return new Google_Service_Sheets(
            $this->createGoogleClient(),
        );
    }

    /**
     * @return \Google_Client
     */
    public function createGoogleClient(): Google_Client
    {
        $client = new Google_Client();
        $client->setApplicationName($this->getConfig()->getApplicationName());
        $client->setScopes($this->getConfig()->getScopes());
        $client->setAccessType($this->getConfig()->getAccessType());
        $client->setAuthConfig($this->getConfig()->getSpreadsheetsCredentials());

        return $client;
    }
}
