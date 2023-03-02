<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Twig;

use SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface;
use SprykerDemo\Zed\FrontendConfiguratorGui\Business\FrontendConfiguratorGuiFacadeInterface;
use SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiConfig;
use Spryker\Shared\Twig\TwigFunctionProvider;
use Twig\Environment;

class BackofficeLogoTwigFunctionProvider extends TwigFunctionProvider
{
    public const FUNCTION_NAME = 'backofficeLogo';

    /**
     * @var \SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface
     */
    protected FrontendConfiguratorGuiFacadeInterface $frontendConfigFacade;

    /**
     * @param \SprykerDemo\Zed\FrontendConfiguratorGui\Business\FrontendConfiguratorGuiFacadeInterface $frontendConfigFacade
     */
    public function __construct(FrontendConfiguratorGuiFacadeInterface $frontendConfigFacade)
    {
        $this->frontendConfigFacade = $frontendConfigFacade;
    }

    /**
     * @param \Twig\Environment $environment
     * @param string $class
     *
     * @return string
     */
    public function getBackofficeLogo(
        Environment $environment,
        string $class = ''
    ): string {
        $configContainerTransfer = $this->frontendConfigFacade->getFrontendGuiConfigContainer();
        $backofficeLogoUrl = $configContainerTransfer->getData()[FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE] ?? null;

        return $environment->render('@Gui/Partials/backoffice-logo.twig', [
            'backofficeLogoUrl' => $backofficeLogoUrl,
            'class' => $class,
        ]);
    }

    /**
     * @return string
     */
    public function getFunctionName(): string
    {
        return static::FUNCTION_NAME;
    }

    /**
     * @return array|callable
     */
    public function getFunction()
    {
        return [$this, 'getBackofficeLogo'];
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return array_merge(parent::getOptions(), [
            'needs_environment' => true,
        ]);
    }
}
