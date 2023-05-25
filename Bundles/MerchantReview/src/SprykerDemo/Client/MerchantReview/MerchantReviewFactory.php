<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReview;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use SprykerDemo\Client\MerchantReview\Calculator\MerchantReviewSummaryCalculator;
use SprykerDemo\Client\MerchantReview\Zed\MerchantReviewStub;
use SprykerDemo\Client\MerchantReview\Zed\MerchantReviewStubInterface;

/**
 * @method \SprykerDemo\Shared\MerchantReview\MerchantReviewConfig getConfig()
 */
class MerchantReviewFactory extends AbstractFactory
{
    /**
     * @return \SprykerDemo\Client\MerchantReview\Zed\MerchantReviewStubInterface
     */
    public function createMerchantReviewStub(): MerchantReviewStubInterface
    {
        return new MerchantReviewStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient(): ZedRequestClientInterface
    {
        return $this->getProvidedDependency(MerchantReviewDependencyProvider::CLIENT_ZED_REQUEST);
    }

    /**
     * @return \SprykerDemo\Client\MerchantReview\Calculator\MerchantReviewSummaryCalculator
     */
    public function createMerchantReviewSummaryCalculator(): MerchantReviewSummaryCalculator
    {
        return new MerchantReviewSummaryCalculator($this->getConfig());
    }
}
