<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewStorage\Storage;

interface MerchantReviewStorageKeyGeneratorInterface
{
    /**
     * @param string $resourceName
     * @param int $resourceId
     *
     * @return string
     */
    public function generateKey(string $resourceName, int $resourceId): string;
}
