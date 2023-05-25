<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Shared\MerchantReview;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class MerchantReviewConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_TYPE_MERCHANT_REVIEW = 'merchant_review';

    /**
     * @var string
     */
    public const ELASTICSEARCH_INDEX_TYPE_NAME = 'merchant-review';

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
        return 5;
    }
}
