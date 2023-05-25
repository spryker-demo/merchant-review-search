<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Persistence;

use Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerDemo\Zed\MerchantReview\Persistence\Propel\Mapper\MerchantReviewMapper;

/**
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewQueryContainerInterface getQueryContainer()
 * @method \SprykerDemo\Zed\MerchantReview\MerchantReviewConfig getConfig()
 */
class MerchantReviewPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    public function createMerchantReviewQuery(): SpyMerchantReviewQuery
    {
        return SpyMerchantReviewQuery::create();
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReview\Persistence\Propel\Mapper\MerchantReviewMapper
     */
    public function createMerchantReviewMapper(): MerchantReviewMapper
    {
        return new MerchantReviewMapper();
    }
}
