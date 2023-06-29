<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\FrontendConfiguratorGui\Communication;

use Spryker\Service\FileSystem\FileSystemServiceInterface;
use SprykerDemo\Zed\FrontendConfiguratorGui\Communication\FormHandler\FrontendConfigurationFormHandlerInterface;
use SprykerDemo\Zed\FrontendConfiguratorGui\Communication\FormHandler\FrontendConfigurationFormHandler;
use SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface;
use SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Form\DataProvider\FrontendConfigurationFormDataProvider;
use SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Form\FrontendConfigurationForm;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Twig\BackofficeLogoTwigFunctionProvider;
use SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiDependencyProvider;
use Symfony\Component\Form\FormInterface;
use Twig\TwigFunction;

/**
 * @method \SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiConfig getConfig()
 */
class FrontendConfiguratorGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getFrontendConfigGuiForm(): FormInterface
    {
        $dataProvider = $this->createFrontendConfigGuiFormDataProvider();

        return $this->getFormFactory()->create(FrontendConfigurationForm::class, $dataProvider->getData());
    }

    /**
     * @return \SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Form\DataProvider\FrontendConfigurationFormDataProvider
     */
    public function createFrontendConfigGuiFormDataProvider(): FrontendConfigurationFormDataProvider
    {
        return new FrontendConfigurationFormDataProvider($this->getFrontendConfigFacade());
    }

    /**
     * @return \Twig\TwigFunction
     */
    public function createBackofficeLogoTwigFunction(): TwigFunction
    {
        $functionProvider = $this->createBackofficeLogoTwigFunctionProvider();

        return new TwigFunction(
            $functionProvider->getFunctionName(),
            $functionProvider->getFunction(),
            $functionProvider->getOptions()
        );
    }

    /**
     * @return \SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Twig\BackofficeLogoTwigFunctionProvider
     */
    public function createBackofficeLogoTwigFunctionProvider(): BackofficeLogoTwigFunctionProvider
    {
        return new BackofficeLogoTwigFunctionProvider($this->getFrontendConfigFacade());
    }

    /**
     * @return \SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface
     */
    public function getFrontendConfigFacade(): FrontendConfiguratorFacadeInterface
    {
        return $this->getProvidedDependency(FrontendConfiguratorGuiDependencyProvider::FRONTEND_CONFIGURATOR_FACADE);
    }

    /**
     * @return \SprykerDemo\Zed\FrontendConfiguratorGui\Communication\FormHandler\FrontendConfigurationFormHandlerInterface
     */
    public function createFormHandler(): FrontendConfigurationFormHandlerInterface
    {
        return new FrontendConfigurationFormHandler(
            $this->getFrontendConfigFacade(),
            $this->getFileSystemService(),
            $this->getConfig()
        );
    }

    /**
     * @return \Spryker\Service\FileSystem\FileSystemServiceInterface
     */
    public function getFileSystemService(): FileSystemServiceInterface
    {
        return $this->getProvidedDependency(FrontendConfiguratorGuiDependencyProvider::SERVICE_FILE_SYSTEM);
    }
}
