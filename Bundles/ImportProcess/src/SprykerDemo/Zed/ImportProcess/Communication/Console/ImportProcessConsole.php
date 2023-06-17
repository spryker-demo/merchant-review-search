<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \SprykerDemo\Zed\ImportProcess\Business\ImportProcessFacadeInterface getFacade()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessQueryContainerInterface getQueryContainer()
 * @method \SprykerDemo\Zed\ImportProcess\Persistence\ImportProcessRepositoryInterface getRepository()
 */
class ImportProcessConsole extends Console
{
    public const COMMAND_NAME = 'import-process:import';
    public const DESCRIPTION = 'Execute import process configured in ImportProcess';
    protected const ARGUMENT_ID_PROCESS = 'id-process';
    protected const ARGUMENT_ID_PROCESS_DESCRIPTION = 'pyz_import_process.id_import_process';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_NAME);
        $this->setDescription(self::DESCRIPTION);
        $this->addArgument(
            static::ARGUMENT_ID_PROCESS,
            InputArgument::REQUIRED,
            static::ARGUMENT_ID_PROCESS_DESCRIPTION,
        );

        parent::configure();
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$this->isArgumentProvided($input, static::ARGUMENT_ID_PROCESS)) {
            $this->error(sprintf('Argument "--%s" should be provided.', static::ARGUMENT_ID_PROCESS));

            return static::CODE_ERROR;
        }

        $idImportProcess = (int)$input->getArgument(static::ARGUMENT_ID_PROCESS);

        $dataImporterCombinedReportTransfer = $this->getFacade()->executeImportProcessByIdImportProcess($idImportProcess);

        return $dataImporterCombinedReportTransfer->getFailMessageCompiled()
            ? static::CODE_ERROR
            : static::CODE_SUCCESS;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param string $argumentName
     *
     * @return bool
     */
    protected function isArgumentProvided(InputInterface $input, string $argumentName): bool
    {
        return $input->hasArgument($argumentName)
            && $input->getArgument($argumentName) !== null;
    }
}
