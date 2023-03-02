<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
