<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
