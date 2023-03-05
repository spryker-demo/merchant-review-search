<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewStorage;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;
use SprykerDemo\Client\MerchantReviewStorage\Storage\MerchantReviewStorageKeyGenerator;
use SprykerDemo\Client\MerchantReviewStorage\Storage\MerchantReviewStorageKeyGeneratorInterface;
use SprykerDemo\Client\MerchantReviewStorage\Storage\MerchantReviewStorageReader;
use SprykerDemo\Client\MerchantReviewStorage\Storage\MerchantReviewStorageReaderInterface;

class MerchantReviewStorageFactory extends AbstractFactory
{
    /**
     * @return \SprykerDemo\Client\MerchantReviewStorage\Storage\MerchantReviewStorageReaderInterface
     */
    public function createMerchantReviewStorageReader(): MerchantReviewStorageReaderInterface
    {
        return new MerchantReviewStorageReader($this->getStorageClient(), $this->createMerchantReviewStorageKeyGenerator());
    }

    /**
     * @return \SprykerDemo\Client\MerchantReviewStorage\Storage\MerchantReviewStorageKeyGeneratorInterface
     */
    protected function createMerchantReviewStorageKeyGenerator(): MerchantReviewStorageKeyGeneratorInterface
    {
        return new MerchantReviewStorageKeyGenerator($this->getSynchronizationService());
    }

    /**
     * @return \Spryker\Client\Storage\StorageClientInterface
     */
    protected function getStorageClient(): StorageClientInterface
    {
        return $this->getProvidedDependency(MerchantReviewStorageDependencyProvider::CLIENT_STORAGE);
    }

    /**
     * @return \Spryker\Service\Synchronization\SynchronizationServiceInterface
     */
    protected function getSynchronizationService(): SynchronizationServiceInterface
    {
        return $this->getProvidedDependency(MerchantReviewStorageDependencyProvider::SERVICE_SYNCHRONIZATION);
    }
}
