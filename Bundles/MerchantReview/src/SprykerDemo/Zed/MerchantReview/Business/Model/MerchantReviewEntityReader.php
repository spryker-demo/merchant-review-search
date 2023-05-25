<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Model;

use Generated\Shared\Transfer\MerchantReviewTransfer;
use Orm\Zed\MerchantReview\Persistence\SpyMerchantReview;
use SprykerDemo\Zed\MerchantReview\Business\Exception\MissingMerchantReviewException;
use SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewQueryContainerInterface;

class MerchantReviewEntityReader implements MerchantReviewEntityReaderInterface
{
    /**
     * @var \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewQueryContainerInterface
     */
    protected MerchantReviewQueryContainerInterface $merchantReviewQueryContainer;

    /**
     * @param \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewQueryContainerInterface $merchantReviewQueryContainer
     */
    public function __construct(MerchantReviewQueryContainerInterface $merchantReviewQueryContainer)
    {
        $this->merchantReviewQueryContainer = $merchantReviewQueryContainer;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @throws \SprykerDemo\Zed\MerchantReview\Business\Exception\MissingMerchantReviewException
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview
     */
    public function getMerchantReviewEntity(MerchantReviewTransfer $merchantReviewTransfer): SpyMerchantReview
    {
        $this->assertMerchantReviewForRead($merchantReviewTransfer);

        $merchantReviewEntity = $this->merchantReviewQueryContainer
            ->queryMerchantReviewById($merchantReviewTransfer->getIdMerchantReview())
            ->findOne();

        if (!$merchantReviewEntity) {
            throw new MissingMerchantReviewException(
                sprintf(
                    'Merchant review with id %d could not be found',
                    $merchantReviewTransfer->getIdMerchantReview(),
                ),
            );
        }

        return $merchantReviewEntity;
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
