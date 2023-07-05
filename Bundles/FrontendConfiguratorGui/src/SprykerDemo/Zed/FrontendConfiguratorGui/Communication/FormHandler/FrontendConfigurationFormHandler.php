<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfiguratorGui\Communication\FormHandler;

use Generated\Shared\Transfer\FileSystemContentTransfer;
use Generated\Shared\Transfer\FileSystemDeleteTransfer;
use Spryker\Service\FileSystem\FileSystemServiceInterface;
use SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface;
use SprykerDemo\Zed\FrontendConfigurator\FrontendConfiguratorConfig;
use SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Form\FrontendConfigurationForm;
use SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiConfig;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FrontendConfigurationFormHandler implements FrontendConfigurationFormHandlerInterface
{
    /**
     * @var \SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface
     */
    protected FrontendConfiguratorFacadeInterface $frontendConfigFacade;

    /**
     * @var \Spryker\Service\FileSystem\FileSystemServiceInterface
     */
    protected FileSystemServiceInterface $fileSystemService;

    /**
     * @var \SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiConfig
     */
    protected FrontendConfiguratorGuiConfig $config;

    /**
     * @param \SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface $frontendConfigFacade
     * @param \Spryker\Service\FileSystem\FileSystemServiceInterface $fileSystemService
     * @param \SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiConfig $config
     */
    public function __construct(
        FrontendConfiguratorFacadeInterface $frontendConfigFacade,
        FileSystemServiceInterface $fileSystemService,
        FrontendConfiguratorGuiConfig $config
    ) {
        $this->frontendConfigFacade = $frontendConfigFacade;
        $this->fileSystemService = $fileSystemService;
        $this->config = $config;
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return void
     */
    public function handle(FormInterface $form): void
    {
        $formData = $form->getData();

        $formData = $this->setDefaultColor($formData);
        $frontendConfiguratorTransfer = $this->frontendConfigFacade->getFrontendConfiguration();
        $frontendConfiguratorTransfer->setName(FrontendConfiguratorConfig::FRONTEND_CONFIG_REDIS_KEY_SUFFIX);

        $shopLogoUrl = $this->uploadFile($formData[FrontendConfigurationForm::FRONTEND_GUI_FIELD_LOGO_FILE])
            ?? $frontendConfiguratorTransfer->getData()[FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_LOGO_FILE] ?? null;
        $backofficeLogoUrl = $this->uploadFile($formData[FrontendConfigurationForm::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE])
            ?? $frontendConfiguratorTransfer->getData()[FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE] ?? null;

        if ($formData[FrontendConfigurationForm::FRONTEND_GUI_FIELD_LOGO_FILE_DELETE]) {
            $this->deleteFile($frontendConfiguratorTransfer->getData()[FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_LOGO_FILE] ?? null);
            $shopLogoUrl = null;
        }

        if ($formData[FrontendConfigurationForm::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE_DELETE]) {
            $this->deleteFile($frontendConfiguratorTransfer->getData()[FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE] ?? null);
            $backofficeLogoUrl = null;
        }

        unset($formData[FrontendConfigurationForm::FRONTEND_GUI_FIELD_LOGO_FILE_DELETE], $formData[FrontendConfigurationForm::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE_DELETE]);

        $frontendConfiguratorTransfer->setData(array_merge(
            $formData,
            [
                FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_LOGO_FILE => $shopLogoUrl,
                FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE => $backofficeLogoUrl,
            ],
        ));

        $this->frontendConfigFacade
            ->saveFrontendConfiguration($frontendConfiguratorTransfer);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile|null $file
     *
     * @return string|null
     */
    protected function uploadFile(?UploadedFile $file): ?string
    {
        if ($file !== null) {
            $fileSystemName = $this->config->getFileSystemName();
            $filePath = $this->config->getFileSystemConfigByName($fileSystemName)['path'] . $this->generateUniqueFileName($file);
            $fileSystemContentTransfer = new FileSystemContentTransfer();
            $fileSystemContentTransfer->setFileSystemName($fileSystemName);
            $fileSystemContentTransfer->setPath($filePath);
            $fileSystemContentTransfer->setContent($file->getContent());
            $fileSystemContentTransfer->setConfig($this->config->getFileSystemWriterConfig());
            $this->fileSystemService->write($fileSystemContentTransfer);

            return $this->getPublicUrl(
                $filePath,
                $fileSystemName,
            );
        }

        return null;
    }

    /**
     * @param string|null $filePath
     *
     * @return void
     */
    protected function deleteFile(?string $filePath): void
    {
        if ($filePath) {
            $fileSystemDeleteTransfer = new FileSystemDeleteTransfer();
            $fileSystemDeleteTransfer->setFileSystemName($this->config->getFileSystemName());
            $fileSystemDeleteTransfer->setPath($filePath);
        }
    }

    /**
     * @param array<string, mixed> $formData
     *
     * @return array<string, mixed>
     */
    protected function setDefaultColor(array $formData): array
    {
        foreach ($this->config->getColorsMarkersNames() as $color) {
            if ($formData[$color . 'switch'] === false) {
                $formData[$color] = '#0000';
            }
        }

        return $formData;
    }

    /**
     * @param string $filePath
     * @param string $fileSystemName
     *
     * @return string
     */
    protected function getPublicUrl(string $filePath, string $fileSystemName): string
    {
        $s3BucketConfig = $this->config->getFileSystemConfigByName($fileSystemName);

        return sprintf(
            'https://%s.s3.%s.amazonaws.com/%s',
            $s3BucketConfig['bucket'],
            $s3BucketConfig['region'],
            $filePath,
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function generateUniqueFileName(UploadedFile $file): string
    {
        return time() . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
    }
}
