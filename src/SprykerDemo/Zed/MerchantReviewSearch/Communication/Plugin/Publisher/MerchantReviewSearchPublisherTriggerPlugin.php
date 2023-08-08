<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Communication\Plugin\Publisher;

use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\MerchantReviewCriteriaTransfer;
use Orm\Zed\MerchantReview\Persistence\Map\SpyMerchantReviewTableMap;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherTriggerPluginInterface;
use SprykerDemo\Shared\MerchantReviewSearch\MerchantReviewSearchConfig;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Communication\MerchantReviewSearchCommunicationFactory getFactory()
 */
class MerchantReviewSearchPublisherTriggerPlugin extends AbstractPlugin implements PublisherTriggerPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $offset
     * @param int $limit
     *
     * @return array<\Generated\Shared\Transfer\MerchantReviewTransfer>
     */
    public function getData(int $offset, int $limit): array
    {
        $merchantReviewCollectionTransfer = $this->getFactory()->getMerchantReviewFacade()->getMerchantReviews($this->createCriteriaTransfer($offset, $limit));

        return $merchantReviewCollectionTransfer->getMerchantReviews()->getArrayCopy();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getResourceName(): string
    {
        return MerchantReviewSearchConfig::MERCHANT_REVIEW_RESOURCE_NAME;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getEventName(): string
    {
        return MerchantReviewSearchConfig::MERCHANT_REVIEW_PUBLISH;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string|null
     */
    public function getIdColumnName(): ?string
    {
        return SpyMerchantReviewTableMap::COL_ID_MERCHANT_REVIEW;
    }

    /**
     * @param int $offset
     * @param int $limit
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCriteriaTransfer
     */
    protected function createCriteriaTransfer(int $offset, int $limit): MerchantReviewCriteriaTransfer
    {
        return (new MerchantReviewCriteriaTransfer())->setFilter(
            (new FilterTransfer())
            ->setOffset($offset)
            ->setLimit($limit)
            ->setOrderBy(SpyMerchantReviewTableMap::COL_ID_MERCHANT_REVIEW)
            ->setOrderDirection('ASC'),
        );
    }
}
