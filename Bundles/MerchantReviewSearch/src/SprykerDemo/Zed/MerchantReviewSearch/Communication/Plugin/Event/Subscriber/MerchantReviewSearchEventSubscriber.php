<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewSearch\Communication\Plugin\Event\Subscriber;

use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerDemo\Zed\MerchantReview\Dependency\MerchantReviewEvents;
use SprykerDemo\Zed\MerchantReviewSearch\Communication\Plugin\Event\Listener\MerchantReviewSearchListener;

/**
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Communication\MerchantReviewSearchCommunicationFactory getFactory()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Business\MerchantReviewSearchFacadeInterface getFacade()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\MerchantReviewSearchConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReviewSearch\Persistence\MerchantReviewSearchQueryContainerInterface getQueryContainer()
 */
class MerchantReviewSearchEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @api
     *
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        $this->addMerchantReviewPublishSearchListener($eventCollection);
        $this->addMerchantReviewUnpublishSearchListener($eventCollection);
        $this->addMerchantReviewCreateSearchListener($eventCollection);
        $this->addMerchantReviewUpdateSearchListener($eventCollection);
        $this->addMerchantReviewDeleteSearchListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addMerchantReviewPublishSearchListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(MerchantReviewEvents::MERCHANT_REVIEW_SEARCH_PUBLISH, new MerchantReviewSearchListener(), 0, null, $this->getConfig()->getEventQueueName());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addMerchantReviewUnpublishSearchListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(MerchantReviewEvents::MERCHANT_REVIEW_SEARCH_UNPUBLISH, new MerchantReviewSearchListener(), 0, null, $this->getConfig()->getEventQueueName());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addMerchantReviewCreateSearchListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(MerchantReviewEvents::ENTITY_SPY_MERCHANT_REVIEW_CREATE, new MerchantReviewSearchListener(), 0, null, $this->getConfig()->getEventQueueName());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addMerchantReviewUpdateSearchListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(MerchantReviewEvents::ENTITY_SPY_MERCHANT_REVIEW_UPDATE, new MerchantReviewSearchListener(), 0, null, $this->getConfig()->getEventQueueName());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addMerchantReviewDeleteSearchListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(MerchantReviewEvents::ENTITY_SPY_MERCHANT_REVIEW_DELETE, new MerchantReviewSearchListener(), 0, null, $this->getConfig()->getEventQueueName());
    }
}
