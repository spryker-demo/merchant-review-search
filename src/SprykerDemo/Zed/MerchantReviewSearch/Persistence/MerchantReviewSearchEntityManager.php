<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Persistence;

use Generated\Shared\Transfer\MerchantReviewSearchTransfer;
use Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearch;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchPersistenceFactory getFactory()
 */
class MerchantReviewSearchEntityManager extends AbstractEntityManager implements MerchantReviewSearchEntityManagerInterface
{
    /**
     * @param array<int> $merchantReviewIds
     *
     * @return void
     */
    public function deleteMerchantReviewSearchByMerchantReviewIds(array $merchantReviewIds): void
    {
        $this->getFactory()
            ->createMerchantReviewSearchQuery()
            ->filterByFkMerchantReview_In($merchantReviewIds)
            ->find()
            ->delete();
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewSearchTransfer $merchantReviewSearchTransfer
     *
     * @return void
     */
    public function saveMerchnatReviewSearch(MerchantReviewSearchTransfer $merchantReviewSearchTransfer): void
    {
        $merchantReviewSearchEntity = $this->getFactory()->createMerchantReviewSearchMapper()->mapMerchantReviewSearchTransferToMerchantReviewSearchEntity($merchantReviewSearchTransfer, new SpyMerchantReviewSearch());
        $merchantReviewSearchEntity->save();
    }
}
