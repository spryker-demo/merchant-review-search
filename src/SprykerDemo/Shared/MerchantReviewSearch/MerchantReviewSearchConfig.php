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
     * - Queue name as used for processing merchant review messages.
     *
     * @api
     *
     * @var string
     */
    public const MERCHANT_REVIEW_SYNC_SEARCH_ERROR_QUEUE = 'sync.search.merchant_review.error';

    /**
     * Specification:
     * - Resource name, this will use for key generating.
     *
     * @api
     *
     * @var string
     */
    public const MERCHANT_REVIEW_RESOURCE_NAME = 'merchant_review';

    /**
     * Specification
     * - This events will be used for spy_merchant_review publishing.
     *
     * @api
     *
     * @var string
     */
    public const MERCHANT_REVIEW_PUBLISH = 'MerchantReview.merchant_review.publish';

    /**
     * Specification
     * - This events will be used for spy_merchant_review un-publishing.
     *
     * @api
     *
     * @var string
     */
    public const MERCHANT_REVIEW_UNPUBLISH = 'MerchantReview.merchant_review.unpublish';

    /**
     * Specification
     * - This events will be used for spy_merchant_review entity update.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_SPY_MERCHANT_REVIEW_UPDATE = 'Entity.spy_merchant_review.update';

    /**
     * Specification
     * - This events will be used for spy_merchant_review entity deletion.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_SPY_MERCHANT_REVIEW_DELETE = 'Entity.spy_merchant_review.delete';
}
