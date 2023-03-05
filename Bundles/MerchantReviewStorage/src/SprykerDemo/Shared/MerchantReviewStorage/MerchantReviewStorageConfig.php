<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Shared\MerchantReviewStorage;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class MerchantReviewStorageConfig extends AbstractBundleConfig
{
    /**
     * Specification:
     * - Queue name as used for processing price messages
     *
     * @api
     *
     * @var string
     */
    public const MERCHANT_REVIEW_SYNC_STORAGE_QUEUE = 'sync.storage.merchant';

    /**
     * Specification:
     * - Queue name as used for processing price messages
     *
     * @api
     *
     * @var string
     */
    public const MERCHANT_REVIEW_SYNC_STORAGE_ERROR_QUEUE = 'sync.storage.merchant.error';

    /**
     * Specification:
     * - Resource name, this will use for key generating
     *
     * @api
     *
     * @var string
     */
    public const MERCHANT_REVIEW_RESOURCE_NAME = 'merchant_review';
}
