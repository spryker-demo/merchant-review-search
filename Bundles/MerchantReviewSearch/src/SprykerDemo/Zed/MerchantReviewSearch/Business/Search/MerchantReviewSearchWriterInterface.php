<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Business\Search;

interface MerchantReviewSearchWriterInterface
{
    /**
     * @param array $merchantReviewIds
     *
     * @return void
     */
    public function publish(array $merchantReviewIds): void;

    /**
     * @param array $merchantReviewIds
     *
     * @return void
     */
    public function unpublish(array $merchantReviewIds): void;
}
