<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Client\FrontendConfigurator;

use SprykerDemo\Client\FrontendConfigurator\Storage\FrontendConfiguratorStubInterface;
use Spryker\Client\Kernel\AbstractClient;
use Generated\Shared\Transfer\ConfigContainerTransfer;

/**
 * @method \SprykerDemo\Client\FrontendConfigurator\FrontendConfiguratorFactory getFactory()
 */
class FrontendConfiguratorClient extends AbstractClient implements FrontendConfiguratorClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function getFrontendConfigContainer(): ConfigContainerTransfer
    {
        return $this->getFactory()
            ->createZedStub()
            ->getFrontendConfigContainer(new ConfigContainerTransfer());
    }

    /**
     * @return \SprykerDemo\Client\FrontendConfigurator\Storage\FrontendConfiguratorStubInterface
     */
    protected function getZedStub(): FrontendConfiguratorStubInterface
    {
        return $this->getFactory()->createZedStub();
    }
}
