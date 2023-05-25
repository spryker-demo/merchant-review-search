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
  * Defines resource name, that will be used for key generation.
  *
  * @var string
  */
    public const MERCHANT_RESOURCE_NAME = 'merchant-review';

    /**
     * Defines queue name as used for processing translation messages.
     *
     * @var string
     */
    public const SYNC_SEARCH_MERCHANT = 'sync.search.merchant-review';

    /**
     * This events that will be used for key writing.
     *
     * @var string
     */
    public const MERCHANT_PUBLISH = 'Merchant.merchant-review.publish';

    /**
     * This events will be used for spy_merchant-review entity creation.
     *
     * @var string
     */
    public const ENTITY_SPY_MERCHANT_CREATE = 'Entity.spy_merchant-review.create';

    /**
     * This events will be used for spy_merchant-review entity changes.
     *
     * @var string
     */
    public const ENTITY_SPY_MERCHANT_UPDATE = 'Entity.spy_merchant-review.update';

    /**
     * This events will be used for spy_merchant-review entity deletion.
     *
     * @var string
     */
    public const ENTITY_SPY_MERCHANT_DELETE = 'Entity.spy_merchant-review.delete';

    /**
     * @uses \Spryker\Zed\Merchant\MerchantConfig::STATUS_APPROVED
     *
     * @var string
     */
    public const MERCHANT_STATUS_APPROVED = 'approved';
}
