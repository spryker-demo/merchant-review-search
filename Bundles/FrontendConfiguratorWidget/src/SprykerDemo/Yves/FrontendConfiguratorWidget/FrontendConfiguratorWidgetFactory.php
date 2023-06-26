<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Yves\FrontendConfiguratorWidget;

use Spryker\Yves\Kernel\AbstractFactory;
use SprykerDemo\Client\FrontendConfigurator\FrontendConfiguratorClientInterface;

class FrontendConfiguratorWidgetFactory extends AbstractFactory
{
    /**
     * @return \SprykerDemo\Client\FrontendConfigurator\FrontendConfiguratorClientInterface
     */
    public function getFrontendConfigClient(): FrontendConfiguratorClientInterface
    {
        return $this->getProvidedDependency(FrontendConfiguratorWidgetDependencyProvider::CLIENT_FRONTEND_CONFIG);
    }
}
