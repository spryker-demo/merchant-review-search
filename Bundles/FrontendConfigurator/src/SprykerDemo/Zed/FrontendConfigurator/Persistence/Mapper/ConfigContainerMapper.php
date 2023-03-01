<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\FrontendConfigurator\Persistence\Mapper;

use Generated\Shared\Transfer\ConfigContainerTransfer;
use Orm\Zed\ConfigContainer\Persistence\PyzConfigContainer;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class ConfigContainerMapper implements ConfigContainerMapperInterface
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
     * @param \Orm\Zed\ConfigContainer\Persistence\PyzConfigContainer $configContainerEntity
     *
     * @return \Orm\Zed\ConfigContainer\Persistence\PyzConfigContainer
     */
    public function mapConfigContainerTransferToConfigContainerEntity(
        ConfigContainerTransfer $configContainerTransfer,
        PyzConfigContainer $configContainerEntity
    ): PyzConfigContainer {
        $configContainerEntity->setName($configContainerTransfer->getName());
        $configContainerEntity->setData($configContainerTransfer->getData()
            ? $this->utilEncodingService->encodeJson($configContainerTransfer->getData())
            : '{}');

        return $configContainerEntity;
    }

    /**
     * @param \Orm\Zed\ConfigContainer\Persistence\PyzConfigContainer $configContainerEntity
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function mapConfigContainerEntityToConfigContainerTransfer(
        PyzConfigContainer $configContainerEntity,
        ConfigContainerTransfer $configContainerTransfer
    ): ConfigContainerTransfer {
        $configContainerTransfer->setName($configContainerEntity->getName());
        $configContainerTransfer->setData($configContainerEntity->getData()
            ? $this->utilEncodingService->decodeJson($configContainerEntity->getData(), true)
            : []);

        return $configContainerTransfer;
    }
}
