<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Business\Reader;

use Generated\Shared\Transfer\ImportProcessTransfer;
use SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessRepositoryInterface;

class Reader implements ReaderInterface
{
    /**
     * @var \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessRepositoryInterface
     */
    protected $importProcessRepository;

    /**
     * @param \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessRepositoryInterface $importProcessRepository
     */
    public function __construct(ImportProcessRepositoryInterface $importProcessRepository)
    {
        $this->importProcessRepository = $importProcessRepository;
    }

    /**
     * @param int $idImportProcess
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer|null
     */
    public function findImportProcessById(int $idImportProcess): ?ImportProcessTransfer
    {
        return $this->importProcessRepository->findImportProcessById($idImportProcess);
    }

    /**
     * @param int $idUser
     *
     * @return \Generated\Shared\Transfer\ImportProcessTransfer[]
     */
    public function findImportProcessesByIdUser(int $idUser): array
    {
        return $this->importProcessRepository->findImportProcessesByIdUser($idUser);
    }
}
