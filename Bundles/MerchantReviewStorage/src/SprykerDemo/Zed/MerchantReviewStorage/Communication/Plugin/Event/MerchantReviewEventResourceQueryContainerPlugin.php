<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Communication\Plugin\Event;

use Orm\Zed\MerchantReview\Persistence\Map\SpyMerchantReviewTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\EventBehavior\Dependency\Plugin\EventResourceQueryContainerPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerDemo\Shared\MerchantReviewStorage\MerchantReviewStorageConfig;
use SprykerDemo\Zed\MerchantReview\Dependency\MerchantReviewEvents;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageQueryContainerInterface getQueryContainer()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Business\MerchantReviewStorageFacadeInterface getFacade()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Communication\MerchantReviewStorageCommunicationFactory getFactory()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\MerchantReviewStorageConfig getConfig()
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
        return MerchantReviewStorageConfig::MERCHANT_REVIEW_RESOURCE_NAME;
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
        $query = $this->getQueryContainer()->queryMerchantReviewsByIds($ids);

        if ($ids === []) {
            $query->clear();
        }

        return $query->distinct()->orderBy($this->getIdColumnName());
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
        return MerchantReviewEvents::MERCHANT_REVIEW_PUBLISH;
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
        return SpyMerchantReviewTableMap::COL_FK_MERCHANT;
    }
}
