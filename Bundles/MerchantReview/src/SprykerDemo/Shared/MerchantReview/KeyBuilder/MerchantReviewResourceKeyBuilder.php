<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Shared\MerchantReview\KeyBuilder;

use SprykerDemo\Shared\MerchantReview\MerchantReviewConfig;
use Spryker\Shared\KeyBuilder\SharedResourceKeyBuilder;

class MerchantReviewResourceKeyBuilder extends SharedResourceKeyBuilder
{
    /**
     * @return string
     */
    protected function getResourceType(): string
    {
        return MerchantReviewConfig::RESOURCE_TYPE_MERCHANT_REVIEW;
    }
}
