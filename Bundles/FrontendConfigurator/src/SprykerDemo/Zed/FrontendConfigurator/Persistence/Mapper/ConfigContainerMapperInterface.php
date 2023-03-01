<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\FrontendConfigurator\Persistence\Mapper;

use Generated\Shared\Transfer\ConfigContainerTransfer;
use Orm\Zed\ConfigContainer\Persistence\PyzConfigContainer;

interface ConfigContainerMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     * @param \Orm\Zed\ConfigContainer\Persistence\PyzConfigContainer $configContainerEntity
     *
     * @return \Orm\Zed\ConfigContainer\Persistence\PyzConfigContainer
     */
    public function mapConfigContainerTransferToConfigContainerEntity(
        ConfigContainerTransfer $configContainerTransfer,
        PyzConfigContainer $configContainerEntity
    ): PyzConfigContainer;

    /**
     * @param \Orm\Zed\ConfigContainer\Persistence\PyzConfigContainer $configContainerEntity
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function mapConfigContainerEntityToConfigContainerTransfer(
        PyzConfigContainer $configContainerEntity,
        ConfigContainerTransfer $configContainerTransfer
    ): ConfigContainerTransfer;
}
