<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfigurator\Persistence\Mapper;

use Generated\Shared\Transfer\ConfigContainerTransfer;
use Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfigurator;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class ConfigContainerMapper
{
    /**
     * @var \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(UtilEncodingServiceInterface $utilEncodingService)
    {
        $this->utilEncodingService = $utilEncodingService;
    }

    /**
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     * @param \Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfigurator $configContainerEntity
     *
     * @return \Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfigurator
     */
    public function mapConfigContainerTransferToConfigContainerEntity(
        ConfigContainerTransfer $configContainerTransfer,
        SpyFrontendConfigurator $configContainerEntity
    ): SpyFrontendConfigurator {
        $configContainerEntity->setName($configContainerTransfer->getName());
        $configContainerEntity->setData($configContainerTransfer->getData()
            ? $this->utilEncodingService->encodeJson($configContainerTransfer->getData())
            : '{}');

        return $configContainerEntity;
    }

    /**
     * @param \Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfigurator $configContainerEntity
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function mapConfigContainerEntityToConfigContainerTransfer(
        SpyFrontendConfigurator $configContainerEntity,
        ConfigContainerTransfer $configContainerTransfer
    ): ConfigContainerTransfer {
        $configContainerTransfer->setName($configContainerEntity->getName());
        $configContainerTransfer->setData($configContainerEntity->getData()
            ? $this->utilEncodingService->decodeJson($configContainerEntity->getData(), true)
            : []);

        return $configContainerTransfer;
    }
}
