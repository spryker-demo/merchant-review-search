<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Plugin\Twig\Buttons\Form;

use Spryker\Zed\Twig\Communication\Plugin\AbstractTwigExtensionPlugin;

/**
 * @method \SprykerDemo\Zed\FrontendConfiguratorGui\Communication\FrontendConfiguratorGuiCommunicationFactory getFactory()
 */
class BackofficeLogoTwigExtensionPlugin extends AbstractTwigExtensionPlugin
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<\Twig\TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            $this->getFactory()->createBackofficeLogoTwigFunction(),
        ];
    }
}
