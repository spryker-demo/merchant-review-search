<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfigurator\Business;

use Generated\Shared\Transfer\FrontendConfiguratorTransfer;
use org\bovigo\vfs\visitor\vfsStreamPrintVisitor;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use SprykerDemo\Zed\FrontendConfigurator\FrontendConfiguratorConfig;

/**
 * @method \SprykerDemo\Zed\FrontendConfigurator\Persistence\FrontendConfiguratorEntityManagerInterface getEntityManager()
 * @method \SprykerDemo\Zed\FrontendConfigurator\Persistence\FrontendConfiguratorRepositoryInterface getRepository()
 */
class FrontendConfiguratorFacade extends AbstractFacade implements FrontendConfiguratorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $name
     *
     * @return \Generated\Shared\Transfer\FrontendConfiguratorTransfer
     */
    public function getFrontendConfiguration(string $name = FrontendConfiguratorConfig::FRONTEND_CONFIG_REDIS_KEY_SUFFIX): FrontendConfiguratorTransfer
    {
        return $this->getRepository()
            ->getFrontendConfigurationByName($name);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\FrontendConfiguratorTransfer $frontendConfiguratorTransfer
     *
     * @return void
     */
    public function saveFrontendConfiguration(FrontendConfiguratorTransfer $frontendConfiguratorTransfer): void
    {
        $this->getEntityManager()
            ->saveFrontendConfiguration($frontendConfiguratorTransfer);
    }
}
