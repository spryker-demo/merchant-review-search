<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Yves\FrontendConfiguratorWidget;

use Spryker\Yves\Kernel\AbstractFactory;
use SprykerDemo\Client\FrontendConfiguratorStorage\FrontendConfiguratorStorageClientInterface;

class FrontendConfiguratorWidgetFactory extends AbstractFactory
{
    /**
     * @return \SprykerDemo\Client\FrontendConfiguratorStorage\FrontendConfiguratorStorageClientInterface
     */
    public function getFrontendConfiguratorStorageClient(): FrontendConfiguratorStorageClientInterface
    {
        return $this->getProvidedDependency(FrontendConfiguratorWidgetDependencyProvider::CLIENT_FRONTEND_CONFIGURATOR_STORAGE);
    }
}
