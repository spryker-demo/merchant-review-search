<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\FrontendConfiguratorGui\Communication\FormHandler;

use SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface;
use SprykerDemo\Zed\FrontendConfigurator\FrontendConfiguratorConfig;
use SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Form\FrontendConfigurationForm;
use SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiConfig;
use SprykerDemo\Zed\Uploads\Business\UploadsFacadeInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FrontendConfigurationFrontendConfigurationFormHandler implements FrontendConfigurationFormHandlerInterface
{
    /**
     * @var \SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface
     */
    protected FrontendConfiguratorFacadeInterface $frontendConfigFacade;

    /**
     * @var \SprykerDemo\Zed\Uploads\Business\UploadsFacadeInterface
     */
    protected UploadsFacadeInterface $uploadsFacade;

    /**
     * @var \SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiConfig
     */
    protected FrontendConfiguratorGuiConfig $config;

    /**
     * @param \SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface $frontendConfigFacade
     * @param \SprykerDemo\Zed\Uploads\Business\UploadsFacadeInterface $uploadsFacade
     * @param \SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiConfig $config
     */
    public function __construct(
        FrontendConfiguratorFacadeInterface $frontendConfigFacade,
        UploadsFacadeInterface $uploadsFacade,
        FrontendConfiguratorGuiConfig $config
    ) {
        $this->frontendConfigFacade = $frontendConfigFacade;
        $this->uploadsFacade = $uploadsFacade;
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
        $configContainerTransfer = $this->frontendConfigFacade->getFrontendGuiConfigContainer();
        $configContainerTransfer->setName(FrontendConfiguratorConfig::FRONTEND_CONFIG_CONTAINER_NAME);

        $shopLogoUrl = $this->uploadFile($formData[FrontendConfigurationForm::FRONTEND_GUI_FIELD_LOGO_FILE])
            ?? $configContainerTransfer->getData()[FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_LOGO_FILE] ?? null;
        $backofficeLogoUrl = $this->uploadFile($formData[FrontendConfigurationForm::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE])
            ?? $configContainerTransfer->getData()[FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE] ?? null;

        if ($formData[FrontendConfigurationForm::FRONTEND_GUI_FIELD_LOGO_FILE_DELETE]) {
            $this->deleteFile($configContainerTransfer->getData()[FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_LOGO_FILE] ?? null);
            $shopLogoUrl = null;
        }

        if ($formData[FrontendConfigurationForm::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE_DELETE]) {
            $this->deleteFile($configContainerTransfer->getData()[FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE] ?? null);
            $backofficeLogoUrl = null;
        }

        unset($formData[FrontendConfigurationForm::FRONTEND_GUI_FIELD_LOGO_FILE_DELETE], $formData[FrontendConfigurationForm::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE_DELETE]);

        $configContainerTransfer->setData(array_merge(
            $formData,
            [
                FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_LOGO_FILE => $shopLogoUrl,
                FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE => $backofficeLogoUrl,
            ]
        ));

        $this->frontendConfigFacade
            ->saveFrontendGuiConfigContainer($configContainerTransfer);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile|null $file
     *
     * @return string|null
     */
    protected function uploadFile(?UploadedFile $file): ?string
    {
        if ($file !== null) {
            $uploadedFileData = $this->uploadsFacade
                ->upload(
                    $file,
                    $this->config->getFileSystemName(),
                );

            return $uploadedFileData['filePublicPath'];
        }

        return null;
    }

    /**
     * @param string|null $filename
     *
     * @return void
     */
    protected function deleteFile(?string $filename): void
    {
        if ($filename) {
            $this->uploadsFacade
                ->remove(
                    $filename,
                    $this->config->getFileSystemName(),
                );
        }
    }

    /**
     * @param array $formData
     *
     * @return array
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
}
