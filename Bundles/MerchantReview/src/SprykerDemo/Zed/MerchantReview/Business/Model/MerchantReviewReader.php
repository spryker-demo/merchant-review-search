<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Model;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewRepositoryInterface;

class MerchantReviewReader implements MerchantReviewReaderInterface
{
    /**
     * @var \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewRepositoryInterface
     */
    protected MerchantReviewRepositoryInterface $merchantReviewRepository;

    /**
     * @param \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewRepositoryInterface $merchantReviewRepository
     */
    public function __construct(MerchantReviewRepositoryInterface $merchantReviewRepository)
    {
        $this->merchantReviewRepository = $merchantReviewRepository;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer|null
     */
    public function findMerchantReview(MerchantReviewTransfer $merchantReviewTransfer): ?MerchantReviewTransfer
    {
        $this->assertMerchantReviewForRead($merchantReviewTransfer);

        return $this->merchantReviewRepository
            ->findMerchantReviewById($merchantReviewTransfer->getIdMerchantReview());
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return void
     */
    protected function assertMerchantReviewForRead(MerchantReviewTransfer $merchantReviewTransfer): void
    {
        $merchantReviewTransfer->requireIdMerchantReview();
    }

    public function getMerchantReviews(): MerchantReviewCollectionTransfer
    {
        return $this->merchantReviewRepository->getMerchantReviews();
    }
}
