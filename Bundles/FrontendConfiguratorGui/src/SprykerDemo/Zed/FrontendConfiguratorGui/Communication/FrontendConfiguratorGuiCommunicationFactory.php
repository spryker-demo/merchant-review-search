<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\FrontendConfiguratorGui\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Twig\BackofficeLogoTwigFunctionProvider;
use Twig\TwigFunction;

/**
 * @method \SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiConfig getConfig()
 */
class FrontendConfiguratorGuiCommunicationFactory extends AbstractCommunicationFactory
{
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
        return new BackofficeLogoTwigFunctionProvider($this->getFacade());
    }

}
