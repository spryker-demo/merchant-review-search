<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\FrontendConfigurator\Persistence\Mapper;

use Generated\Shared\Transfer\ConfigContainerTransfer;
use Orm\Zed\ConfigContainer\Persistence\PyzConfigContainer;
use Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfigurator;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

interface ConfigContainerMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     * @param \Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfigurator $configContainerEntity
     *
     * @return \Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfigurator
     */
    public function mapConfigContainerTransferToConfigContainerEntity(
        ConfigContainerTransfer $configContainerTransfer,
        SpyFrontendConfigurator $configContainerEntity
    ): SpyFrontendConfigurator;

    /**
     * @param \Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfigurator $configContainerEntity
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function mapConfigContainerEntityToConfigContainerTransfer(
        SpyFrontendConfigurator $configContainerEntity,
        ConfigContainerTransfer $configContainerTransfer
    ): ConfigContainerTransfer;
}
