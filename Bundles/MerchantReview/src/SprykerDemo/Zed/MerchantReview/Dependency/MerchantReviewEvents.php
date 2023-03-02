<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\MerchantReview\Dependency;

interface MerchantReviewEvents
{
    /**
     * Specification
     * - This events will be used for merchant_review_search publishing
     *
     * @api
     *
     * @var string
     */
    public const MERCHANT_REVIEW_SEARCH_PUBLISH = 'ProductReview.merchant_review_search.publish';

    /**
     * Specification
     * - This events will be used for merchant_review_search un-publishing
     *
     * @api
     *
     * @var string
     */
    public const MERCHANT_REVIEW_SEARCH_UNPUBLISH = 'ProductReview.merchant_review_search.unpublish';

    /**
     * Specification
     * - This events will be used for spy_merchant_review publishing
     *
     * @api
     *
     * @var string
     */
    public const MERCHANT_REVIEW_PUBLISH = 'MerchantReview.merchant_review.publish';

    /**
     * Specification
     * - This events will be used for spy_merchant_review un-publishing
     *
     * @api
     *
     * @var string
     */
    public const MERCHANT_REVIEW_UNPUBLISH = 'MerchantReview.merchant_review.unpublish';

    /**
     * Specification
     * - This events will be used for spy_merchant_review entity creation
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_SPY_MERCHANT_REVIEW_CREATE = 'Entity.spy_merchant_review.create';

    /**
     * Specification
     * - This events will be used for spy_merchant_review entity update
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_SPY_MERCHANT_REVIEW_UPDATE = 'Entity.spy_merchant_review.update';

    /**
     * Specification
     * - This events will be used for spy_merchant_review entity deletion
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_SPY_MERCHANT_REVIEW_DELETE = 'Entity.spy_merchant_review.delete';
}
