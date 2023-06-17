<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Service\GoogleSpreadsheets;

use SprykerDemo\Service\GoogleSpreadsheets\Model\SpreadsheetsReader;
use SprykerDemo\Service\GoogleSpreadsheets\Model\SpreadsheetsReaderInterface;
use Spryker\Service\Kernel\AbstractServiceFactory;

/**
 * @method \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsConfig getConfig()
 */
class GoogleSpreadsheetsServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \SprykerDemo\Service\GoogleSpreadsheets\Model\SpreadsheetsReaderInterface
     */
    public function createSpreadsheetReader(): SpreadsheetsReaderInterface
    {
        return new SpreadsheetsReader($this->getConfig());
    }
}
