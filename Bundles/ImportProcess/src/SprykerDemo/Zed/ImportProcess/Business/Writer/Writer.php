<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\Writer;

use Generated\Shared\Transfer\ImportProcessTransfer;
use SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface;

class Writer implements WriterInterface
{
    /**
     * @var \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface
     */
    protected $importProcessEntityManager;

    /**
     * @param \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessEntityManagerInterface $importProcessEntityManager
     */
    public function __construct(ImportProcessEntityManagerInterface $importProcessEntityManager)
    {
        $this->importProcessEntityManager = $importProcessEntityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\ImportProcessTransfer $importProcessTransfer
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer
     */
    public function saveImportProcess(
        ImportProcessTransfer $importProcessTransfer
    ): ImportProcessTransfer {
        return $this->importProcessEntityManager->saveImportProcessEntity($importProcessTransfer);
    }
}
