<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewStorage\Storage;

use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;

class MerchantReviewStorageKeyGenerator implements MerchantReviewStorageKeyGeneratorInterface
{
    /**
     * @var array<\Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface>
     */
    protected static array $storageKeyBuilders = [];

    /**
     * @var \Spryker\Service\Synchronization\SynchronizationServiceInterface
     */
    protected SynchronizationServiceInterface $synchronizationService;

    /**
     * @param \Spryker\Service\Synchronization\SynchronizationServiceInterface $synchronizationService
     */
    public function __construct(SynchronizationServiceInterface $synchronizationService)
    {
        $this->synchronizationService = $synchronizationService;
    }

    /**
     * @param string $resourceName
     * @param int $resourceId
     *
     * @return string
     */
    public function generateKey(string $resourceName, int $resourceId): string
    {
        $synchronizationDataTransfer = new SynchronizationDataTransfer();
        $synchronizationDataTransfer
            ->setReference((string)$resourceId);

        return $this->getStorageKeyBuilder($resourceName)
            ->generateKey($synchronizationDataTransfer);
    }

    /**
     * @param string $resourceName
     *
     * @return \Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface
     */
    protected function getStorageKeyBuilder(string $resourceName): SynchronizationKeyGeneratorPluginInterface
    {
        if (!isset(static::$storageKeyBuilders[$resourceName])) {
            static::$storageKeyBuilders[$resourceName] = $this->synchronizationService->getStorageKeyBuilder(
                $resourceName,
            );
        }

        return static::$storageKeyBuilders[$resourceName];
    }
}
