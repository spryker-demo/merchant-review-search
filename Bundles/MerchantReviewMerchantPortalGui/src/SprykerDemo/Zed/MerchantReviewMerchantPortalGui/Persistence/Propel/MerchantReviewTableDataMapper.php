<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\Propel;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Orm\Zed\MerchantReview\Persistence\Map\SpyMerchantReviewTableMap;

class MerchantReviewTableDataMapper
{
    /**
     * @var string
     */
    protected const COL_KEY_CREATED_AT = 'created_at';

    /**
     * @var string
     */
    protected const COL_KEY_RATING = 'rating';

    /**
     * @var string
     */
    protected const COL_KEY_DESCRIPTION = 'description';

    /**
     * @var string
     */
    protected const COL_KEY_SUMMARY = 'summary';

    /**
     * @var string
     */
    protected const COL_KEY_NICKNAME = 'nickname';

    /**
     * @var array<string, string>
     */
    public const MERCHANT_REVIEW_DATA_COLUMN_MAP = [
        self::COL_KEY_CREATED_AT => SpyMerchantReviewTableMap::COL_CREATED_AT,
        self::COL_KEY_DESCRIPTION => SpyMerchantReviewTableMap::COL_DESCRIPTION,
        self::COL_KEY_NICKNAME => SpyMerchantReviewTableMap::COL_NICKNAME,
        self::COL_KEY_RATING => SpyMerchantReviewTableMap::COL_RATING,
        self::COL_KEY_SUMMARY => SpyMerchantReviewTableMap::COL_SUMMARY,
    ];

    /**
     * @param array<mixed> $merchantReviewTableDataArray
     * @param \Generated\Shared\Transfer\MerchantReviewCollectionTransfer $merchantReviewCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function mapMerchantReviewTableDataArrayToMerchantReviewCollectionTransfer(
        array $merchantReviewTableDataArray,
        MerchantReviewCollectionTransfer $merchantReviewCollectionTransfer
    ): MerchantReviewCollectionTransfer {
        foreach ($merchantReviewTableDataArray as $merchantReviewTableRowDataArray) {
            $merchantReviewTransfer = (new MerchantReviewTransfer())->fromArray($merchantReviewTableRowDataArray, true);
            $merchantReviewCollectionTransfer->addMerchantReview($merchantReviewTransfer);
        }

        return $merchantReviewCollectionTransfer;
    }
}
