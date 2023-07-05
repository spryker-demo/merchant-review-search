<?php

namespace SprykerDemo\Service\MerchantReview;

use Spryker\Service\Kernel\AbstractBundleConfig;

/**
 * @method \SprykerDemo\Shared\MerchantReview\MerchantReviewConfig getSharedConfig()
 */
class MerchantReviewConfig extends AbstractBundleConfig
{
    /**
     * Specification:
     * - Retrieves the available maximum rating value
     *
     * @api
     *
     * @return int
     */
    public function getMaximumRating(): int
    {
        return $this->getSharedConfig()->getMaximumRating();
    }
}
