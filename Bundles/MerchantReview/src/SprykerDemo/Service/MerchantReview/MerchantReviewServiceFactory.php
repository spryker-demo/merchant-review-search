<?php

namespace SprykerDemo\Service\MerchantReview;

use Spryker\Service\Kernel\AbstractServiceFactory;
use SprykerDemo\Service\MerchantReview\Calculator\MerchantReviewSummaryCalculator;

/**
 * @method \SprykerDemo\Service\MerchantReview\MerchantReviewConfig getConfig()
 */
class MerchantReviewServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \SprykerDemo\Client\MerchantReview\Calculator\MerchantReviewSummaryCalculator
     */
    public function createMerchantReviewSummaryCalculator(): MerchantReviewSummaryCalculator
    {
        return new MerchantReviewSummaryCalculator($this->getConfig());
    }
}
