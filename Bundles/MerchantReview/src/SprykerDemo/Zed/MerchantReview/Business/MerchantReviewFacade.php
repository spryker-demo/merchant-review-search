<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\MerchantReview\Business\MerchantReviewBusinessFactory getFactory()
 */
class MerchantReviewFacade extends AbstractFacade implements MerchantReviewFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function createMerchantReview(
        MerchantReviewTransfer $merchantReviewTransfer
    ): MerchantReviewTransfer {
        return $this->getFactory()
            ->createMerchantReviewCreator()
            ->createMerchantReview($merchantReviewTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer|null
     */
    public function findOne(
        MerchantReviewTransfer $merchantReviewTransfer
    ): ?MerchantReviewTransfer {
        return $this->getFactory()
            ->createMerchantReviewReader()
            ->findMerchantReview($merchantReviewTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function updateMerchantReviewStatus(
        MerchantReviewTransfer $merchantReviewTransfer
    ): MerchantReviewTransfer {
        return $this->getFactory()
            ->createMerchantReviewStatusUpdater()
            ->updateMerchantReviewStatus($merchantReviewTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return void
     */
    public function deleteMerchantReview(
        MerchantReviewTransfer $merchantReviewTransfer
    ): void {
        $this->getFactory()
            ->createMerchantReviewDeleter()
            ->deleteMerchantReview($merchantReviewTransfer);
    }

    public function getMerchantReviews(): MerchantReviewCollectionTransfer
    {
        return $this->getFactory()->createMerchantReviewReader()->getMerchantReviews();
    }
}
