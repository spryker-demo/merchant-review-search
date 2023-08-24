<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Persistence;

use Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearchQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerDemo\Zed\MerchantReviewSearch\Persistence\Propel\Mapper\MerchantReviewSearchMapper;

class MerchantReviewSearchPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\MerchantReviewSearch\Persistence\SpyMerchantReviewSearchQuery
     */
    public function createMerchantReviewSearchQuery(): SpyMerchantReviewSearchQuery
    {
        return SpyMerchantReviewSearchQuery::create();
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReviewSearch\Persistence\Propel\Mapper\MerchantReviewSearchMapper
     */
    public function createMerchantReviewSearchMapper(): MerchantReviewSearchMapper
    {
        return new MerchantReviewSearchMapper();
    }
}
