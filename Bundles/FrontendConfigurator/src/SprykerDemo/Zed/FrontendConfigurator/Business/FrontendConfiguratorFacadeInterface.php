<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfigurator\Business;

use Generated\Shared\Transfer\FrontendConfiguratorTransfer;
use SprykerDemo\Zed\FrontendConfigurator\FrontendConfiguratorConfig;

interface FrontendConfiguratorFacadeInterface
{
    /**
     * Specification:
     * - Gets frontend configuration
     *
     * @api
     *
     * @param string $name
     *
     * @return \Generated\Shared\Transfer\FrontendConfiguratorTransfer
     */
    public function getFrontendConfiguration(string $name = FrontendConfiguratorConfig::FRONTEND_CONFIG_REDIS_KEY_SUFFIX): FrontendConfiguratorTransfer;

    /**
     * Specification:
     * - Persists frontend configuration
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\FrontendConfiguratorTransfer $frontendConfiguratorTransfer
     *
     * @return void
     */
    public function saveFrontendConfiguration(FrontendConfiguratorTransfer $frontendConfiguratorTransfer): void;
}
