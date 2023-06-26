<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
