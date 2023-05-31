<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Model;

use Generated\Shared\Transfer\MerchantReviewTransfer;
use Orm\Zed\MerchantReview\Persistence\SpyMerchantReview;
use SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewRepositoryInterface;

class MerchantReviewEntityReader implements MerchantReviewEntityReaderInterface
{
    protected MerchantReviewRepositoryInterface $merchantReviewRepository;

    protected MerchantReviewMapper $merchantReviewMapper;

    /**
     * @param \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewRepositoryInterface $merchantReviewRepository
     * @param \SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewMapper $merchantReviewMapper
     */
    public function __construct(
        MerchantReviewRepositoryInterface $merchantReviewRepository,
        MerchantReviewMapper $merchantReviewMapper
    ) {
        $this->merchantReviewMapper = $merchantReviewMapper;
        $this->merchantReviewRepository = $merchantReviewRepository;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview
     */
    public function getMerchantReviewEntity(MerchantReviewTransfer $merchantReviewTransfer): SpyMerchantReview
    {
        $this->assertMerchantReviewForRead($merchantReviewTransfer);

        $merchantReviewTransfer = $this->merchantReviewRepository->findMerchantReviewById($merchantReviewTransfer->getIdMerchantReview());

        return $this->merchantReviewMapper->mapMerchantReviewTransferToEntity($merchantReviewTransfer);
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
}
