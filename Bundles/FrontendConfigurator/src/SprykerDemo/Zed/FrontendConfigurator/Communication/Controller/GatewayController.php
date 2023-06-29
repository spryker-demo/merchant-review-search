<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfigurator\Communication\Controller;

use Generated\Shared\Transfer\ConfigContainerTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \SprykerDemo\Zed\FrontendConfigurator\Business\FrontendConfiguratorFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function getFrontendConfiguratorAction(ConfigContainerTransfer $configContainerTransfer): ConfigContainerTransfer
    {
        return $this->getFacade()
            ->getFrontendGuiConfigContainer();
    }
}
