<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfigurator\Business;

use Generated\Shared\Transfer\ConfigContainerTransfer;

interface FrontendConfiguratorFacadeInterface
{
    /**
     * Specification:
     * - Gets frontend configuration
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function getFrontendGuiConfigContainer(): ConfigContainerTransfer;

    /**
     * Specification:
     * - Persists frontend configuration
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function saveFrontendGuiConfigContainer(ConfigContainerTransfer $configContainerTransfer): ConfigContainerTransfer;

    /**
     * Specification:
     * - Persists ConfigContainerTransfer
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function saveConfigContainer(ConfigContainerTransfer $configContainerTransfer): ConfigContainerTransfer;

    /**
     * Specification:
     * - Gets ConfigContainerTransfer by name
     *
     * @api
     *
     * @param string $name
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function getConfigContainerByName(string $name): ConfigContainerTransfer;
}
