<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Model;

use Generated\Shared\Transfer\MerchantReviewTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;

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
