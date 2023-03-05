<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Business\Storage;

interface MerchantReviewStorageWriterInterface
{
    /**
     * @param array<int> $merchantIds
     *
     * @return void
     */
    public function publish(array $merchantIds): void;

    /**
     * @param array<int> $merchantIds
     *
     * @return void
     */
    public function unpublish(array $merchantIds): void;
}
