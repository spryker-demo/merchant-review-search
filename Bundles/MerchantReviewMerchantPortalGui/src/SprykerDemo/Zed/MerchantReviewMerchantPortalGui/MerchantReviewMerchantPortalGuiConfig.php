<?php

namespace SprykerDemo\Zed\MerchantReviewMerchantPortalGui;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class MerchantReviewMerchantPortalGuiConfig extends AbstractBundleConfig
{
    protected const MERCHANT_REVIEW_DEFAULT_PAGE_SIZE = 25;

    /**
     * @return int
     */
    public function getMerchantReviewDefaultPageSize(): int
    {
        return static::MERCHANT_REVIEW_DEFAULT_PAGE_SIZE;
    }
}
