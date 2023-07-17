<?php

namespace SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\Propel;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Orm\Zed\MerchantReview\Persistence\Map\SpyMerchantReviewTableMap;

class MerchantReviewTableDataMapper
{
    protected const COL_KEY_CREATED_AT = 'created_at';

    protected const COL_KEY_RATING = 'rating';

    protected const COL_KEY_DESCRIPTION = 'description';

    protected const COL_KEY_SUMMARY = 'summary';

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
