<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Merchant\Business\MerchantFacadeInterface;
use SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewCreator;
use SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewCreatorInterface;
use SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewDeleter;
use SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewDeleterInterface;
use SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewEntityReader;
use SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewEntityReaderInterface;
use SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewMapper;
use SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewReader;
use SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewReaderInterface;
use SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewStatusUpdater;
use SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewStatusUpdaterInterface;
use SprykerDemo\Zed\MerchantReview\MerchantReviewDependencyProvider;

/**
 * @method \SprykerDemo\Zed\MerchantReview\MerchantReviewConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewRepositoryInterface getRepository()
 */
class MerchantReviewBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewCreatorInterface
     */
    public function createMerchantReviewCreator(): MerchantReviewCreatorInterface
    {
        return new MerchantReviewCreator($this->getConfig());
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewReaderInterface
     */
    public function createMerchantReviewReader(): MerchantReviewReaderInterface
    {
        return new MerchantReviewReader($this->getRepository());
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewStatusUpdaterInterface
     */
    public function createMerchantReviewStatusUpdater(): MerchantReviewStatusUpdaterInterface
    {
        return new MerchantReviewStatusUpdater($this->createMerchantReviewEntityReader());
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewEntityReaderInterface
     */
    protected function createMerchantReviewEntityReader(): MerchantReviewEntityReaderInterface
    {
        return new MerchantReviewEntityReader($this->getRepository(), $this->createMerchantReviewMapper());
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewDeleterInterface
     */
    public function createMerchantReviewDeleter(): MerchantReviewDeleterInterface
    {
        return new MerchantReviewDeleter($this->createMerchantReviewEntityReader());
    }

    /**
     * @return \Spryker\Zed\Merchant\Business\MerchantFacadeInterface
     */
    protected function getMerchantFacade(): MerchantFacadeInterface
    {
        return $this->getProvidedDependency(MerchantReviewDependencyProvider::FACADE_MERCHANT);
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReview\Business\Model\MerchantReviewMapper
     */
    protected function createMerchantReviewMapper(): MerchantReviewMapper
    {
        return new MerchantReviewMapper();
    }
}
