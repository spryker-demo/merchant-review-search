<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Business\MerchantReviewStorageBusinessFactory getFactory()
 */
class MerchantReviewStorageFacade extends AbstractFacade implements MerchantReviewStorageFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $merchantIds
     *
     * @return void
     */
    public function publish(array $merchantIds): void
    {
        $this->getFactory()
            ->createMerchantReviewStorageWriter()
            ->publish($merchantIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $merchantIds
     *
     * @return void
     */
    public function unpublish(array $merchantIds): void
    {
        $this->getFactory()
            ->createMerchantReviewStorageWriter()
            ->unpublish($merchantIds);
    }
}
