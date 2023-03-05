<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerDemo\Zed\MerchantReviewStorage\Business\Storage\MerchantReviewStorageWriter;
use SprykerDemo\Zed\MerchantReviewStorage\Business\Storage\MerchantReviewStorageWriterInterface;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\MerchantReviewStorageConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageQueryContainerInterface getQueryContainer()
 */
class MerchantReviewStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerDemo\Zed\MerchantReviewStorage\Business\Storage\MerchantReviewStorageWriterInterface
     */
    public function createMerchantReviewStorageWriter(): MerchantReviewStorageWriterInterface
    {
        return new MerchantReviewStorageWriter(
            $this->getQueryContainer(),
            $this->getConfig()
                ->isSendingToQueue(),
        );
    }
}
