<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Model;

use Generated\Shared\Transfer\MerchantReviewTransfer;
use Orm\Zed\MerchantReview\Persistence\Map\SpyMerchantReviewTableMap;
use Orm\Zed\MerchantReview\Persistence\SpyMerchantReview;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;
use SprykerDemo\Shared\MerchantReview\Exception\RatingOutOfRangeException;
use SprykerDemo\Shared\MerchantReview\MerchantReviewConfig;

class MerchantReviewCreator implements MerchantReviewCreatorInterface
{
    use TransactionTrait;

    /**
     * @var \SprykerDemo\Shared\MerchantReview\MerchantReviewConfig
     */
    protected MerchantReviewConfig $merchantReviewConfig;

    public function __construct(MerchantReviewConfig $merchantReviewConfig)
    {
        $this->merchantReviewConfig = $merchantReviewConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function createMerchantReview(MerchantReviewTransfer $merchantReviewTransfer): MerchantReviewTransfer
    {
        $this->assertRatingRange($merchantReviewTransfer);

        return $this->getTransactionHandler()
            ->handleTransaction(function () use ($merchantReviewTransfer) {
                return $this->executeCreateMerchantReviewTransaction($merchantReviewTransfer);
            });
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @throws \SprykerDemo\Shared\MerchantReview\Exception\RatingOutOfRangeException
     *
     * @return void
     */
    protected function assertRatingRange(MerchantReviewTransfer $merchantReviewTransfer): void
    {
        if ($merchantReviewTransfer->getRating() > $this->merchantReviewConfig->getMaximumRating()) {
            throw new RatingOutOfRangeException(
                sprintf(
                    'Field Rating exceeds limit %d',
                    $this->merchantReviewConfig->getMaximumRating(),
                ),
            );
        }
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    protected function executeCreateMerchantReviewTransaction(MerchantReviewTransfer $merchantReviewTransfer
    ): MerchantReviewTransfer {
        $merchantReviewEntity = $this->createMerchantReviewEntity($merchantReviewTransfer);

        $this->mapEntityToTransfer($merchantReviewTransfer, $merchantReviewEntity);

        return $merchantReviewTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview
     */
    protected function createMerchantReviewEntity(MerchantReviewTransfer $merchantReviewTransfer): SpyMerchantReview
    {
        $merchantReviewEntity = new SpyMerchantReview();
        $merchantReviewEntity->fromArray($merchantReviewTransfer->toArray());
        $merchantReviewEntity = $this->setInitialStatus($merchantReviewEntity);

        $merchantReviewEntity->save();

        return $merchantReviewEntity;
    }

    /**
     * @param \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview $merchantReviewEntity
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview
     */
    protected function setInitialStatus(SpyMerchantReview $merchantReviewEntity): SpyMerchantReview
    {
        $merchantReviewEntity->setStatus(SpyMerchantReviewTableMap::COL_STATUS_PENDING);

        return $merchantReviewEntity;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     * @param \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview $merchantReviewEntity
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    protected function mapEntityToTransfer(
        MerchantReviewTransfer $merchantReviewTransfer, SpyMerchantReview $merchantReviewEntity
    ): MerchantReviewTransfer {
        $merchantReviewTransfer->fromArray($merchantReviewEntity->toArray(), true);

        return $merchantReviewTransfer;
    }
}
