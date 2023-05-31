<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Model;

use Generated\Shared\Transfer\MerchantReviewTransfer;
use Orm\Zed\MerchantReview\Persistence\SpyMerchantReview;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class MerchantReviewStatusUpdater implements MerchantReviewStatusUpdaterInterface
{
    use TransactionTrait;

    /**
     * @var \SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewEntityReaderInterface
     */
    protected MerchantReviewEntityReaderInterface $merchantReviewEntityReader;

    /**
     * @param \SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewEntityReaderInterface $merchantReviewEntityReader
     */
    public function __construct(MerchantReviewEntityReaderInterface $merchantReviewEntityReader)
    {
        $this->merchantReviewEntityReader = $merchantReviewEntityReader;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function updateMerchantReviewStatus(MerchantReviewTransfer $merchantReviewTransfer): MerchantReviewTransfer
    {
        $this->assertMerchantReviewTransfer($merchantReviewTransfer);

        return $this->getTransactionHandler()
            ->handleTransaction(function () use ($merchantReviewTransfer) {
                return $this->executeUpdateMerchantReviewStatusTransaction($merchantReviewTransfer);
            });
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return void
     */
    protected function assertMerchantReviewTransfer(MerchantReviewTransfer $merchantReviewTransfer): void
    {
        $merchantReviewTransfer->requireIdMerchantReview();
        $merchantReviewTransfer->requireStatus();
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    protected function executeUpdateMerchantReviewStatusTransaction(MerchantReviewTransfer $merchantReviewTransfer): MerchantReviewTransfer
    {
        $merchantReviewEntity = $this->merchantReviewEntityReader->getMerchantReviewEntity($merchantReviewTransfer);

        $this->mapTransferToEntity($merchantReviewTransfer, $merchantReviewEntity);
        $merchantReviewEntity->save();
        $this->mapEntityToTransfer($merchantReviewTransfer, $merchantReviewEntity);

        return $merchantReviewTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     * @param \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview $merchantReviewEntity
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview
     */
    protected function mapTransferToEntity(
        MerchantReviewTransfer $merchantReviewTransfer,
        SpyMerchantReview $merchantReviewEntity
    ): SpyMerchantReview {
        /** @var string $status */
        $status = $merchantReviewTransfer->getStatus();

        $merchantReviewEntity->setStatus($status);
        $merchantReviewEntity->setNew(false);

        return $merchantReviewEntity;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     * @param \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview $merchantReviewEntity
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    protected function mapEntityToTransfer(
        MerchantReviewTransfer $merchantReviewTransfer,
        SpyMerchantReview $merchantReviewEntity
    ): MerchantReviewTransfer {
        $merchantReviewTransfer->fromArray($merchantReviewEntity->toArray(), true);

        return $merchantReviewTransfer;
    }
}
