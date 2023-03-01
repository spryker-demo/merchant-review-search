<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Plugin\Twig\Buttons\Form;

use Spryker\Zed\Twig\Communication\Plugin\AbstractTwigExtensionPlugin;

/**
 * @method \SprykerDemo\Zed\FrontendConfiguratorGui\Communication\FrontendConfiguratorGuiCommunicationFactory getFactory()
 */
class BackofficeLogoTwigExtensionPlugin extends AbstractTwigExtensionPlugin
{
    /**
     * @return \Twig\TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            $this->getFactory()->createBackofficeLogoTwigFunction(),
        ];
    }
}
