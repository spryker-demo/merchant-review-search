<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
