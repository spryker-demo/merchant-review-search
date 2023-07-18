<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Communication\Plugin\Publisher\MerchantReview;

use Orm\Zed\MerchantReview\Persistence\Map\SpyMerchantReviewTableMap;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherTriggerPluginInterface;
use SprykerDemo\Shared\MerchantReviewStorage\MerchantReviewStorageConfig;
use SprykerDemo\Zed\MerchantReview\Dependency\MerchantReviewEvents;

/**
 * {@inheritDoc}
 *
 * @api
 *
 * @method \SprykerDemo\Zed\MerchantReviewStorage\MerchantReviewStorageConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Business\MerchantReviewStorageFacadeInterface getFacade()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Communication\MerchantReviewStorageCommunicationFactory getFactory()
 */
class MerchantReviewPublisherTriggerPlugin extends AbstractPlugin implements PublisherTriggerPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $offset
     * @param int $limit
     *
     * @return array<\Spryker\Shared\Kernel\Transfer\AbstractTransfer>
     */
    public function getData(int $offset, int $limit): array
    {
        $merchantReviewCollectionTransfer = $this->getFactory()->getMerchantReviewFacade()->getMerchantReviews();

        return $merchantReviewCollectionTransfer->getReviews()->getArrayCopy();
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
        return MerchantReviewStorageConfig::MERCHANT_REVIEW_RESOURCE_NAME;
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
        return SpyMerchantReviewTableMap::COL_ID_MERCHANT_REVIEW;
    }
}
