<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfigurator\Persistence\Mapper;

use Generated\Shared\Transfer\FrontendConfiguratorTransfer;
use Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfigurator;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class FrontendConfigurationMapper
{
    /**
     * @var \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected UtilEncodingServiceInterface $utilEncodingService;

    /**
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(UtilEncodingServiceInterface $utilEncodingService)
    {
        $this->utilEncodingService = $utilEncodingService;
    }

    /**
     * @param \Generated\Shared\Transfer\FrontendConfiguratorTransfer $frontendConfiguratorTransfer
     * @param \Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfigurator $frontendConfiguratorEntity
     *
     * @return \Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfigurator
     */
    public function mapFrontendConfiguratorTransferToFrontendConfiguratorEntity(
        FrontendConfiguratorTransfer $frontendConfiguratorTransfer,
        SpyFrontendConfigurator $frontendConfiguratorEntity
    ): SpyFrontendConfigurator {
        $frontendConfiguratorEntity->setName($frontendConfiguratorTransfer->getName());
        $frontendConfiguratorEntity->setData($this->utilEncodingService->encodeJson($frontendConfiguratorTransfer->getData()));

        return $frontendConfiguratorEntity;
    }

    /**
     * @param \Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfigurator $frontendConfiguratorEntity
     * @param \Generated\Shared\Transfer\FrontendConfiguratorTransfer $frontendConfiguratorTransfer
     *
     * @return \Generated\Shared\Transfer\FrontendConfiguratorTransfer
     */
    public function mapFrontendConfiguratorEntityToFrontendConfiguratorTransfer(
        SpyFrontendConfigurator $frontendConfiguratorEntity,
        FrontendConfiguratorTransfer $frontendConfiguratorTransfer
    ): FrontendConfiguratorTransfer {
        $frontendConfiguratorTransfer->setName($frontendConfiguratorEntity->getName());
        $frontendConfiguratorTransfer->setData($frontendConfiguratorEntity->getData()
            ? $this->utilEncodingService->decodeJson($frontendConfiguratorEntity->getData(), true)
            : []);

        return $frontendConfiguratorTransfer;
    }
}
