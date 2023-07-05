<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Twig;

use Spryker\Shared\Twig\TwigFunctionProvider;
use SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface;
use SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiConfig;
use Twig\Environment;

class BackofficeLogoTwigFunctionProvider extends TwigFunctionProvider
{
    /**
     * @var string
     */
    public const FUNCTION_NAME = 'backofficeLogo';

    /**
     * @var \SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface
     */
    protected FrontendConfiguratorFacadeInterface $frontendConfigFacade;

    /**
     * @param \SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface $frontendConfigFacade
     */
    public function __construct(FrontendConfiguratorFacadeInterface $frontendConfigFacade)
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
        $frontendConfiguratorTransfer = $this->frontendConfigFacade->getFrontendConfiguration();
        $backofficeLogoUrl = $frontendConfiguratorTransfer->getData()[FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE] ?? null;

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
     * @return callable
     */
    public function getFunction(): callable
    {
        return [$this, 'getBackofficeLogo'];
    }

    /**
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return array_merge(parent::getOptions(), [
            'needs_environment' => true,
        ]);
    }
}
