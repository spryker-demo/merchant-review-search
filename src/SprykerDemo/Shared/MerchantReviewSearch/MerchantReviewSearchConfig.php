<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Shared\MerchantReviewSearch;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class MerchantReviewSearchConfig extends AbstractBundleConfig
{
    /**
     * Specification:
     * - Queue name as used for processing merchant review messages.
     *
     * @api
     *
     * @var string
     */
    public const MERCHANT_REVIEW_SYNC_SEARCH_QUEUE = 'sync.search.merchant_review';

    /**
     * Specification:
     * - Queue name as used for processing merchant review messages
     *
     * @api
     *
     * @var string
     */
    public const MERCHANT_REVIEW_SYNC_SEARCH_ERROR_QUEUE = 'sync.search.merchant_review.error';
}
