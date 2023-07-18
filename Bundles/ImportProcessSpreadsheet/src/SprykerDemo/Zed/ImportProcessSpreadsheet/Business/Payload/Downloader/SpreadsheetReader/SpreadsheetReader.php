<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet\Business\Payload\Downloader\SpreadsheetReader;

use Generated\Shared\Transfer\ImportProcessSpreadsheetReaderConfigurationTransfer;
use SprykerDemo\Service\GoogleSpreadsheets\Exception\SpreadsheetsException;
use SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceInterface;

class SpreadsheetReader implements SpreadsheetReaderInterface
{
    /**
     * @var int
     */
    protected const INITIAL_HEADER_START_POSITION = 1;

    /**
     * @var int
     */
    protected const INITIAL_HEADER_END_POSITION = 1;

    /**
     * @var int
     */
    protected const OUT_OF_RANGE_EXCEPTION_CODE = 400;

    /**
     * @var int
     */
    protected $position = 0;

    /**
     * @var array<int, mixed>
     */
    protected $rows = [];

    /**
     * @var int
     */
    protected $offset = 1;

    /**
     * @var \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceInterface
     */
    protected $googleSpreadsheetsService;

    /**
     * @var \Generated\Shared\Transfer\ImportProcessSpreadsheetReaderConfigurationTransfer
     */
    protected $spreadsheetReaderConfigurationTransfer;

    /**
     * @var int
     */
    protected $columnsCount;

    /**
     * @param \SprykerDemo\Service\GoogleSpreadsheets\GoogleSpreadsheetsServiceInterface $googleSpreadsheetsService
     * @param \Generated\Shared\Transfer\ImportProcessSpreadsheetReaderConfigurationTransfer $spreadsheetReaderConfigurationTransfer
     */
    public function __construct(
        GoogleSpreadsheetsServiceInterface $googleSpreadsheetsService,
        ImportProcessSpreadsheetReaderConfigurationTransfer $spreadsheetReaderConfigurationTransfer
    ) {
        $this->googleSpreadsheetsService = $googleSpreadsheetsService;
        $this->spreadsheetReaderConfigurationTransfer = $spreadsheetReaderConfigurationTransfer;
        $this->countSheetColumns();
    }

    /**
     * @return void
     */
    protected function countSheetColumns(): void
    {
        $headersRowRange = $this->buildRange(static::INITIAL_HEADER_START_POSITION, static::INITIAL_HEADER_END_POSITION);
        $this->columnsCount = count($this->readFromSpreadsheet($headersRowRange)[0] ?? []);
    }

    /**
     * @return void
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function key()
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        if ($this->columnsCount === 0) {
            return false;
        }

        if (!isset($this->rows[$this->position])) {
            $this->getNextBatch();
        }

        return isset($this->rows[$this->position]);
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->getNextBatch();
    }

    /**
     * @return array<int, mixed>
     */
    public function current(): array
    {
        $currentRow = $this->rows[$this->position];
        $rowValuesCount = count($currentRow);

        if ($rowValuesCount < $this->columnsCount) {
            $currentRow = array_pad($currentRow, $this->columnsCount, '');
        }

        if ($rowValuesCount > $this->columnsCount) {
            $currentRow = array_slice($currentRow, 0, $this->columnsCount);
        }

        return $currentRow;
    }

    /**
     * @return void
     */
    protected function getNextBatch(): void
    {
        if ($this->endOfSheetReached()) {
            return;
        }

        $this->rows = [];
        $this->position = 0;
        $batchRange = $this->buildRange($this->offset, $this->offset + $this->getBatchSize());
        $rows = $this->readFromSpreadsheet($batchRange);

        if (!count($rows)) {
            return;
        }

        $this->offset += $this->getBatchSize();
        $this->rows = $rows;
    }

    /**
     * @return bool
     */
    protected function endOfSheetReached(): bool
    {
        return count($this->rows) > 0 && count($this->rows) < $this->getBatchSize();
    }

    /**
     * @param string $range
     *
     * @throws \SprykerDemo\Service\GoogleSpreadsheets\Exception\SpreadsheetsException
     *
     * @return array<int, mixed>
     */
    protected function readFromSpreadsheet(string $range): array
    {
        try {
            return $this->googleSpreadsheetsService->getSheetContent($this->getSpreadsheetUrl(), $range);
        } catch (SpreadsheetsException $exception) {
            if ($exception->getCode() === static::OUT_OF_RANGE_EXCEPTION_CODE) {
                return [];
            }

            throw $exception;
        }
    }

    /**
     * @param int $start
     * @param int $end
     *
     * @return string
     */
    protected function buildRange(int $start, int $end): string
    {
        return sprintf('%s!%d:%d', $this->getSheetName(), $start, $end);
    }

    /**
     * @return int
     */
    protected function getBatchSize(): int
    {
        return $this->spreadsheetReaderConfigurationTransfer->getBatchSizeOrFail();
    }

    /**
     * @return string
     */
    protected function getSpreadsheetUrl(): string
    {
        return $this->spreadsheetReaderConfigurationTransfer->getSpreadsheetUrlOrFail();
    }

    /**
     * @return string
     */
    protected function getSheetName(): string
    {
        return $this->spreadsheetReaderConfigurationTransfer->getSheetNameOrFail();
    }
}
