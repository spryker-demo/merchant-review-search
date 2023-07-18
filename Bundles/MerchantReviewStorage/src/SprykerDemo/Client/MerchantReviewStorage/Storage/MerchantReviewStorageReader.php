<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewStorage\Storage;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewStorageTransfer;
use Spryker\Client\Storage\StorageClientInterface;
use SprykerDemo\Shared\MerchantReviewStorage\MerchantReviewStorageConfig;

class MerchantReviewStorageReader implements MerchantReviewStorageReaderInterface
{
    /**
     * @var \Spryker\Client\Storage\StorageClientInterface
     */
    protected StorageClientInterface $storageClient;

    /**
     * @var \SprykerDemo\Client\MerchantReviewStorage\Storage\MerchantReviewStorageKeyGeneratorInterface
     */
    protected MerchantReviewStorageKeyGeneratorInterface $merchantReviewStorageKeyGenerator;

    /**
     * @param \Spryker\Client\Storage\StorageClientInterface $storageClient
     * @param \SprykerDemo\Client\MerchantReviewStorage\Storage\MerchantReviewStorageKeyGeneratorInterface $merchantReviewStorageKeyGenerator
     */
    public function __construct(
        StorageClientInterface $storageClient,
        MerchantReviewStorageKeyGeneratorInterface $merchantReviewStorageKeyGenerator
    ) {
        $this->storageClient = $storageClient;
        $this->merchantReviewStorageKeyGenerator = $merchantReviewStorageKeyGenerator;
    }

    /**
     * @param string $key
     *
     * @return \Generated\Shared\Transfer\MerchantReviewStorageTransfer|null
     */
    protected function findMerchantReviewMerchantStorageTransfer(string $key): ?MerchantReviewStorageTransfer
    {
        $imageData = $this->storageClient->get($key);

        if (!$imageData) {
            return null;
        }

        $merchantReviewStorageTransfer = new MerchantReviewStorageTransfer();
        $merchantReviewStorageTransfer->fromArray($imageData, true);

        return $merchantReviewStorageTransfer;
    }

    /**
     * @param int $idMerchant
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function findMerchantReviews(int $idMerchant): MerchantReviewCollectionTransfer
    {
        $key = $this->merchantReviewStorageKeyGenerator->generateKey(
            MerchantReviewStorageConfig::MERCHANT_REVIEW_RESOURCE_NAME,
            $idMerchant,
        );

        $merchantReviewStorageTransfer = $this->findMerchantReviewMerchantStorageTransfer($key);

        return new MerchantReviewCollectionTransfer();
    }
}
