<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

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
