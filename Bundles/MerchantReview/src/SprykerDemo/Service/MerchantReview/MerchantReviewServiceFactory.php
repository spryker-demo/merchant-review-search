<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Service\MerchantReview;

use Spryker\Service\Kernel\AbstractServiceFactory;
use SprykerDemo\Service\MerchantReview\Calculator\MerchantReviewSummaryCalculator;

/**
 * @method \SprykerDemo\Service\MerchantReview\MerchantReviewConfig getConfig()
 */
class MerchantReviewServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \SprykerDemo\Service\MerchantReview\Calculator\MerchantReviewSummaryCalculator
     */
    public function createMerchantReviewSummaryCalculator(): MerchantReviewSummaryCalculator
    {
        return new MerchantReviewSummaryCalculator($this->getConfig());
    }
}
