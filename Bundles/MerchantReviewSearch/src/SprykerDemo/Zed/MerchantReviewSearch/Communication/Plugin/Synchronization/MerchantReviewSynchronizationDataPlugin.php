<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Communication\Plugin\Synchronization;

use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SynchronizationExtension\Dependency\Plugin\SynchronizationDataQueryContainerPluginInterface;
use SprykerDemo\Shared\MerchantReviewSearch\MerchantReviewSearchConfig;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchQueryContainerInterface getQueryContainer()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Business\MerchantReviewSearchFacadeInterface getFacade()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Communication\MerchantReviewSearchCommunicationFactory getFactory()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchConfig getConfig()
 */
class MerchantReviewSynchronizationDataPlugin extends AbstractPlugin implements SynchronizationDataQueryContainerPluginInterface
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
     * @return bool
     */
    public function hasStore(): bool
    {
        return false;
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
    public function queryData($ids = []): ?ModelCriteria
    {
        $query = $this->getQueryContainer()->queryMerchantReviewSearchByIds($ids);

        if ($ids === []) {
            $query->clear();
        }

        return $query->orderByIdMerchantReviewSearch();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array
     */
    public function getParams(): array
    {
        return ['type' => 'merchant-review'];
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getQueueName(): string
    {
        return MerchantReviewSearchConfig::MERCHANT_REVIEW_SYNC_SEARCH_QUEUE;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string|null
     */
    public function getSynchronizationQueuePoolName(): ?string
    {
        return $this->getFactory()->getConfig()->getMerchantReviewSynchronizationPoolName();
    }
}
