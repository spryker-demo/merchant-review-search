<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Client\FrontendConfigurator\Storage;

use Generated\Shared\Transfer\ConfigContainerTransfer;

interface FrontendConfiguratorStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function getFrontendConfigContainer(ConfigContainerTransfer $configContainerTransfer): ConfigContainerTransfer;
}
