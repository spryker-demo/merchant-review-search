<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewSearch;

use Generated\Shared\Transfer\PaginationConfigTransfer;
use Spryker\Client\Kernel\AbstractBundleConfig;

class MerchantReviewSearchConfig extends AbstractBundleConfig
{
    /**
     * @var int
     */
    public const PAGINATION_DEFAULT_ITEMS_PER_PAGE = 10;

    /**
     * @var array<int>
     */
    public const PAGINATION_VALID_ITEMS_PER_PAGE = [
        10,
    ];

    /**
     * @api
     *
     * @return \Generated\Shared\Transfer\PaginationConfigTransfer
     */
    public function getPaginationConfig(): PaginationConfigTransfer
    {
        $paginationConfigTransfer = new PaginationConfigTransfer();
        $paginationConfigTransfer
            ->setParameterName('page')
            ->setItemsPerPageParameterName('ipp')
            ->setDefaultItemsPerPage(static::PAGINATION_DEFAULT_ITEMS_PER_PAGE)
            ->setValidItemsPerPageOptions(static::PAGINATION_VALID_ITEMS_PER_PAGE);

        return $paginationConfigTransfer;
    }
}
