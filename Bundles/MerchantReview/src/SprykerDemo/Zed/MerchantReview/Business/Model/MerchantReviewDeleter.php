<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Model;

use Generated\Shared\Transfer\MerchantReviewTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class MerchantReviewDeleter implements MerchantReviewDeleterInterface
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
     * @return void
     */
    public function deleteMerchantReview(MerchantReviewTransfer $merchantReviewTransfer): void
    {
        $this->getTransactionHandler()->handleTransaction(function () use ($merchantReviewTransfer): void {
            $this->executeDeleteMerchantReviewTransaction($merchantReviewTransfer);
        });
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return void
     */
    protected function executeDeleteMerchantReviewTransaction(MerchantReviewTransfer $merchantReviewTransfer): void
    {
        $merchantReviewEntity = $this->merchantReviewEntityReader->getMerchantReviewEntity($merchantReviewTransfer);
        $merchantReviewTransfer->fromArray($merchantReviewEntity->toArray());

        $merchantReviewEntity->delete();
    }
}
