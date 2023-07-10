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
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewEntityManagerInterface getEntityManager()
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
        return $this->getEntityManager()->createMerchantReview($merchantReviewTransfer);
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
     * @param int $idMerchantReview
     *
     * @return void
     */
    public function deleteMerchantReview(
        int $idMerchantReview
    ): void {
        $this->getEntityManager()->deleteMerchantReview($idMerchantReview);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function getMerchantReviews(): MerchantReviewCollectionTransfer
    {
        return $this->getFactory()->createMerchantReviewReader()->getMerchantReviews();
    }

    public function getMerchantReviewsByIds(array $merchantReviewIds)
    {
        return $this->getFactory()->createMerchantReviewReader()->getMerchantReviewsByIds($merchantReviewIds);
    }
}
