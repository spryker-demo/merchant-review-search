<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Persistence;

use Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewPersistenceFactory getFactory()
 */
class MerchantReviewQueryContainer extends AbstractQueryContainer implements MerchantReviewQueryContainerInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    public function queryMerchantReview(): SpyMerchantReviewQuery
    {
        return $this->getFactory()
            ->createMerchantReviewQuery();
    }
}
