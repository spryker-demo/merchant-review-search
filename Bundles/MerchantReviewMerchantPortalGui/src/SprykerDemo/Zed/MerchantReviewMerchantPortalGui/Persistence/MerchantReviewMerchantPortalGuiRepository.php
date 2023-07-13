<?php

namespace SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewTableCriteriaTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Orm\Zed\MerchantReview\Persistence\Map\SpyMerchantReviewTableMap;
use Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\Criterion\LikeCriterion;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\Propel\MerchantReviewTableDataMapper;

/**
 * @method \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\MerchantReviewMerchantPortalGuiPersistenceFactory getFactory()
 */
class MerchantReviewMerchantPortalGuiRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected const COL_KEY_CREATED_AT = 'created_at';

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTableCriteriaTransfer $merchantReviewTableCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function getMerchantReviewTableData(
        MerchantReviewTableCriteriaTransfer $merchantReviewTableCriteriaTransfer
    ): MerchantReviewCollectionTransfer {
        $merchantReviewPropelQuery = $this->buildMerchantReviewTableBaseQuery($merchantReviewTableCriteriaTransfer);
        $merchantReviewPropelQuery = $this->applyMerchantReviewSearch(
            $merchantReviewPropelQuery,
            $merchantReviewTableCriteriaTransfer,
        );
        $merchantReviewPropelQuery = $this->addMerchantReviewSorting(
            $merchantReviewPropelQuery,
            $merchantReviewTableCriteriaTransfer,
        );

        $propelPager = $merchantReviewPropelQuery->paginate(
            $merchantReviewTableCriteriaTransfer->getPageOrFail(),
            $merchantReviewTableCriteriaTransfer->getPageSizeOrFail(),
        );

        $paginationTransfer = $this->getFactory()->createPropelModelPagerMapper()->mapPropelModelPagerToPaginationTransfer(
            $propelPager,
            new PaginationTransfer(),
        );
        $merchantReviewCollectionTransfer = $this->getFactory()
            ->createMerchantReviewTableDataMapper()
            ->mapProductAbstractTableDataArrayToProductAbstractCollectionTransfer(
                $propelPager->getResults()->getData(),
                new MerchantReviewCollectionTransfer(),
            );
        $merchantReviewCollectionTransfer->setPagination($paginationTransfer);

        return $merchantReviewCollectionTransfer;
    }

    /**
     * @module MerchantProduct
     * @module Product
     * @module ProductImage
     * @module Store
     * @module ProductCategory
     * @module Category
     *
     * @param \Generated\Shared\Transfer\MerchantReviewTableCriteriaTransfer $merchantReviewTableCriteriaTransfer
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    protected function buildMerchantReviewTableBaseQuery(
        MerchantReviewTableCriteriaTransfer $merchantReviewTableCriteriaTransfer
    ): SpyMerchantReviewQuery {
        $merchantReviewPropelQuery = $this->getFactory()->getMerchantReviewPropelQuery();
        $idLocale = $merchantReviewTableCriteriaTransfer->getLocaleOrFail()->getIdLocaleOrFail();
        $idMerchant = $merchantReviewTableCriteriaTransfer->getIdMerchantOrFail();

        $merchantReviewPropelQuery->filterByFkMerchant($idMerchant)
            ->filterByFkLocale($idLocale)
            ->select([
                MerchantReviewTransfer::SUMMARY,
                MerchantReviewTransfer::RATING,
                MerchantReviewTransfer::NICKNAME,
                MerchantReviewTransfer::DESCRIPTION,
                MerchantReviewTransfer::CREATED_AT,
            ]);

        return $merchantReviewPropelQuery;
    }

    /**
     * @param \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery $merchantProductAbstractQuery
     * @param \Generated\Shared\Transfer\MerchantReviewTableCriteriaTransfer $merchantReviewTableCriteriaTransfer
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    protected function applyMerchantReviewSearch(
        SpyMerchantReviewQuery $merchantProductAbstractQuery,
        MerchantReviewTableCriteriaTransfer $merchantReviewTableCriteriaTransfer
    ): SpyMerchantReviewQuery {
        $searchTerm = $merchantReviewTableCriteriaTransfer->getSearchTerm();

        if (!$searchTerm) {
            return $merchantProductAbstractQuery;
        }

        $criteria = new Criteria();
        $nicknameCriterion = $this->getNicknameCriteria($criteria, $searchTerm);
        $summaryCriterion = $this->getMerchantReviewSummarySearchCriteria($criteria, $searchTerm);
        $descriptionCriterion = $this->getMerchantReviewDescriptionSearchCriteria($criteria, $searchTerm);
        $nicknameCriterion->addOr($summaryCriterion);
        $nicknameCriterion->addOr($descriptionCriterion);

        $merchantProductAbstractQuery->addAnd($nicknameCriterion);

        return $merchantProductAbstractQuery;
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\Criteria $criteria
     * @param string $searchTerm
     *
     * @return \Propel\Runtime\ActiveQuery\Criterion\LikeCriterion
     */
    protected function getNicknameCriteria(Criteria $criteria, string $searchTerm): LikeCriterion
    {
        /** @var \Propel\Runtime\ActiveQuery\Criterion\LikeCriterion $likeCriterion */
        $likeCriterion = $criteria->getNewCriterion(
            SpyMerchantReviewTableMap::COL_NICKNAME,
            '%' . $searchTerm . '%',
            Criteria::LIKE,
        );

        return $likeCriterion->setIgnoreCase(true);
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\Criteria $criteria
     * @param string $searchTerm
     *
     * @return \Propel\Runtime\ActiveQuery\Criterion\LikeCriterion
     */
    protected function getMerchantReviewSummarySearchCriteria(Criteria $criteria, string $searchTerm): LikeCriterion
    {
        /** @var \Propel\Runtime\ActiveQuery\Criterion\LikeCriterion $likeCriterion */
        $likeCriterion = $criteria->getNewCriterion(
            SpyMerchantReviewTableMap::COL_SUMMARY,
            '%' . $searchTerm . '%',
            Criteria::LIKE,
        );

        return $likeCriterion->setIgnoreCase(true);
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\Criteria $criteria
     * @param string $searchTerm
     *
     * @return \Propel\Runtime\ActiveQuery\Criterion\LikeCriterion
     */
    protected function getMerchantReviewDescriptionSearchCriteria(Criteria $criteria, string $searchTerm): LikeCriterion
    {
        /** @var \Propel\Runtime\ActiveQuery\Criterion\LikeCriterion $likeCriterion */
        $likeCriterion = $criteria->getNewCriterion(
            SpyMerchantReviewTableMap::COL_DESCRIPTION,
            '%' . $searchTerm . '%',
            Criteria::LIKE,
        );

        return $likeCriterion->setIgnoreCase(true);
    }

    /**
     * @param \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery $merchantReviewQuery
     * @param \Generated\Shared\Transfer\MerchantReviewTableCriteriaTransfer $merchantReviewTableCriteriaTransfer
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    protected function addMerchantReviewSorting(
        SpyMerchantReviewQuery $merchantReviewQuery,
        MerchantReviewTableCriteriaTransfer $merchantReviewTableCriteriaTransfer
    ): SpyMerchantReviewQuery {
        $orderColumn = $merchantReviewTableCriteriaTransfer->getOrderBy() ?? static::COL_KEY_CREATED_AT;
        $orderDirection = $merchantReviewTableCriteriaTransfer->getOrderDirection() ?? Criteria::DESC;

        if (!$orderColumn || !$orderDirection) {
            return $merchantReviewQuery;
        }

        $orderColumn = MerchantReviewTableDataMapper::MERCHANT_REVIEW_DATA_COLUMN_MAP[$orderColumn] ?? $orderColumn;

        if ($orderColumn === SpyMerchantReviewTableMap::COL_CREATED_AT) {
            /** @var \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery<\Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstract> $merchantReviewQuery */
            $merchantReviewQuery = $this->addNaturalSorting($merchantReviewQuery, $orderColumn, $orderDirection);
        }

        $merchantReviewQuery->orderBy($orderColumn, $orderDirection);

        return $merchantReviewQuery;
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria<mixed> $query
     * @param string $orderColumn
     * @param string $orderDirection
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria<mixed>
     */
    protected function addNaturalSorting(
        ModelCriteria $query,
        string $orderColumn,
        string $orderDirection
    ): ModelCriteria {
        if ($orderDirection === Criteria::ASC) {
            $query->addAscendingOrderByColumn("LENGTH($orderColumn)");
        }
        if ($orderDirection === Criteria::DESC) {
            $query->addDescendingOrderByColumn("LENGTH($orderColumn)");
        }

        // DISTINCT query requires it to be in SELECT
        $query->withColumn("LENGTH($orderColumn)");

        return $query;
    }
}
