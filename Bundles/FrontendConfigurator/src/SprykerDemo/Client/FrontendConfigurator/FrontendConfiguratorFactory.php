<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Client\FrontendConfigurator;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use SprykerDemo\Client\FrontendConfigurator\Storage\FrontendConfiguratorReader;
use SprykerDemo\Client\FrontendConfigurator\Storage\FrontendConfiguratorStub;
use SprykerDemo\Client\FrontendConfigurator\Storage\FrontendConfiguratorStubInterface;

class FrontendConfiguratorFactory extends AbstractFactory
{
    /**
     * @return \SprykerDemo\Client\FrontendConfigurator\Storage\FrontendConfiguratorStubInterface
     */
    public function createZedStub(): FrontendConfiguratorStubInterface
    {
        return new FrontendConfiguratorStub($this->getZedRequestClient());
    }

    /**
     * @return \SprykerDemo\Client\FrontendConfigurator\Storage\FrontendConfiguratorStubInterface
     */
    public function createFrontendConfiguratorReader(): FrontendConfiguratorStubInterface
    {
        return new FrontendConfiguratorReader($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient(): ZedRequestClientInterface
    {
        return $this->getProvidedDependency(FrontendConfiguratorDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
