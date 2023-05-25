<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Business\MerchantReviewSearchBusinessFactory getFactory()
 */
class MerchantReviewSearchFacade extends AbstractFacade implements MerchantReviewSearchFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $merchantReviewIds
     *
     * @return void
     */
    public function publish(array $merchantReviewIds): void
    {
        $this->getFactory()->createMerchantReviewWriter()->publish($merchantReviewIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $merchantReviewIds
     *
     * @return void
     */
    public function unpublish(array $merchantReviewIds): void
    {
        $this->getFactory()->createMerchantReviewWriter()->unpublish($merchantReviewIds);
    }
}
