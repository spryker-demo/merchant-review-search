<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\FrontendConfigurator\Business;

use Generated\Shared\Transfer\ConfigContainerTransfer;
use SprykerDemo\Zed\FrontendConfigurator\FrontendConfiguratorConfig;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorBusinessFactory getFactory()
 */
class FrontendConfiguratorFacade extends AbstractFacade implements FrontendConfiguratorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function getFrontendGuiConfigContainer(): ConfigContainerTransfer
    {
        return $this->getConfigContainerByName(FrontendConfiguratorConfig::FRONTEND_CONFIG_CONTAINER_NAME);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function saveFrontendGuiConfigContainer(ConfigContainerTransfer $configContainerTransfer): ConfigContainerTransfer
    {
        return $this->saveConfigContainer($configContainerTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function saveConfigContainer(ConfigContainerTransfer $configContainerTransfer): ConfigContainerTransfer
    {
        return $this->getEntityManager()
            ->saveConfigContainerEntity($configContainerTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $name
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function getConfigContainerByName(string $name): ConfigContainerTransfer
    {
        return $this->getRepository()
            ->getConfigContainerByName($name);
    }
}
