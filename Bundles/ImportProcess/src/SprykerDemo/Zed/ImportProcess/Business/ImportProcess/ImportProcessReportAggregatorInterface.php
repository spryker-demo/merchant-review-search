<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\ImportProcess;

use Generated\Shared\Transfer\ImportProcessReportTransfer;

interface ImportProcessReportAggregatorInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\DataImporterReportTransfer> $dataImporterReportTransfers
     *
     * @return \Generated\Shared\Transfer\ImportProcessReportTransfer
     */
    public function aggregateReports(array $dataImporterReportTransfers): ImportProcessReportTransfer;
}
