<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewMerchantPortalGui;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class MerchantReviewMerchantPortalGuiConfig extends AbstractBundleConfig
{
    /**
     * @var int
     */
    protected const MERCHANT_REVIEW_DEFAULT_PAGE_SIZE = 25;

    /**
     * @api
     *
     * @return int
     */
    public function getMerchantReviewDefaultPageSize(): int
    {
        return static::MERCHANT_REVIEW_DEFAULT_PAGE_SIZE;
    }
}
