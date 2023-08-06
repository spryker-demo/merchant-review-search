<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Persistence;

use Generated\Shared\Transfer\MerchantReviewSearchTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchPersistenceFactory getFactory()
 */
class MerchantReviewSearchRepository extends AbstractRepository implements MerchantReviewSearchRepositoryInterface
{
 /**
  * @param array<int> $merchantReviewIds
  *
  * @return array<\Generated\Shared\Transfer\MerchantReviewSearchTransfer>
  */
    public function getMerchantReviewSearchTransfersIndexedByMerchantReviewId(array $merchantReviewIds): array
    {
        $merchantReviewSearchEntities = $this->getFactory()
            ->createMerchantReviewSearchQuery()
            ->filterByFkMerchantReview_In($merchantReviewIds)
            ->find();

        $merchantReviewSearchTransfers = [];
        $mapper = $this->getFactory()->createMerchantReviewSearchMapper();

        foreach ($merchantReviewSearchEntities as $merchantReviewSearchEntity) {
            $merchantReviewSearchTransfers[$merchantReviewSearchEntity->getFkMerchantReview()] = $mapper->mapMerchantReviewSearchEntityToMerchantReviewSearchTransfer(
                $merchantReviewSearchEntity,
                new MerchantReviewSearchTransfer(),
            );
        }

        return $merchantReviewSearchTransfers;
    }
}
