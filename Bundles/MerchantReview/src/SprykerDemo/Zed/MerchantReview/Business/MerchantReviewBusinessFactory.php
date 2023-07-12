<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Merchant\Business\MerchantFacadeInterface;
use SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewStatusUpdater;
use SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewStatusUpdaterInterface;
use SprykerDemo\Zed\MerchantReview\MerchantReviewDependencyProvider;

/**
 * @method \SprykerDemo\Zed\MerchantReview\MerchantReviewConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewRepositoryInterface getRepository()
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewEntityManagerInterface getEntityManager()
 */
class MerchantReviewBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewStatusUpdaterInterface
     */
    public function createMerchantReviewStatusUpdater(): MerchantReviewStatusUpdaterInterface
    {
        return new MerchantReviewStatusUpdater($this->getEntityManager());
    }

    /**
     * @return \Spryker\Zed\Merchant\Business\MerchantFacadeInterface
     */
    protected function getMerchantFacade(): MerchantFacadeInterface
    {
        return $this->getProvidedDependency(MerchantReviewDependencyProvider::FACADE_MERCHANT);
    }
}
