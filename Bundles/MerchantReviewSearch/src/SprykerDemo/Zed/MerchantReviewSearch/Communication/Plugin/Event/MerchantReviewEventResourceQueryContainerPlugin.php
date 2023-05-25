<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Communication\Plugin\Event;

use Orm\Zed\MerchantReview\Persistence\Map\SpyMerchantReviewTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\EventBehavior\Dependency\Plugin\EventResourceQueryContainerPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerDemo\Shared\MerchantReviewSearch\MerchantReviewSearchConfig;
use SprykerDemo\Zed\MerchantReview\Dependency\MerchantReviewEvents;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchQueryContainerInterface getQueryContainer()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Business\MerchantReviewSearchFacadeInterface getFacade()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Communication\MerchantReviewSearchCommunicationFactory getFactory()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchConfig getConfig()
 */
class MerchantReviewEventResourceQueryContainerPlugin extends AbstractPlugin implements EventResourceQueryContainerPluginInterface
{
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
     * @param array<int> $ids
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria|null
     */
    public function queryData(array $ids = []): ?ModelCriteria
    {
        $query = $this->getQueryContainer()->queryMerchantReviewsByIdMerchantReviews($ids);

        if ($ids === []) {
            $query->clear();
        }

        return $query->orderBy($this->getIdColumnName());
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
        return MerchantReviewEvents::MERCHANT_REVIEW_SEARCH_PUBLISH;
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
}
