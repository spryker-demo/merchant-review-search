<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewStorage\Communication\Plugin\Event\Subscriber;

use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerDemo\Zed\MerchantReview\Dependency\MerchantReviewEvents;
use SprykerDemo\Zed\MerchantReviewStorage\Communication\Plugin\Event\Listener\MerchantReviewPublishStorageListener;
use SprykerDemo\Zed\MerchantReviewStorage\Communication\Plugin\Event\Listener\MerchantReviewStorageListener;

/**
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Communication\MerchantReviewStorageCommunicationFactory getFactory()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Business\MerchantReviewStorageFacadeInterface getFacade()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\MerchantReviewStorageConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReviewStorage\Persistence\MerchantReviewStorageQueryContainerInterface getQueryContainer()
 */
class MerchantReviewStorageEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
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
        $this->addMerchantReviewPublishStorageListener($eventCollection);
        $this->addMerchantReviewUnpublishStorageListener($eventCollection);
        $this->addMerchantReviewCreateStorageListener($eventCollection);
        $this->addMerchantReviewUpdateStorageListener($eventCollection);
        $this->addMerchantReviewDeleteStorageListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addMerchantReviewPublishStorageListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(MerchantReviewEvents::MERCHANT_REVIEW_PUBLISH, new MerchantReviewPublishStorageListener(), 0, null, $this->getConfig()->getEventQueueName());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addMerchantReviewUnpublishStorageListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(MerchantReviewEvents::MERCHANT_REVIEW_UNPUBLISH, new MerchantReviewPublishStorageListener(), 0, null, $this->getConfig()->getEventQueueName());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addMerchantReviewCreateStorageListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(MerchantReviewEvents::ENTITY_SPY_MERCHANT_REVIEW_CREATE, new MerchantReviewStorageListener(), 0, null, $this->getConfig()->getEventQueueName());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addMerchantReviewUpdateStorageListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(MerchantReviewEvents::ENTITY_SPY_MERCHANT_REVIEW_UPDATE, new MerchantReviewStorageListener(), 0, null, $this->getConfig()->getEventQueueName());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addMerchantReviewDeleteStorageListener(EventCollectionInterface $eventCollection): void
    {
        $eventCollection->addListenerQueued(MerchantReviewEvents::ENTITY_SPY_MERCHANT_REVIEW_DELETE, new MerchantReviewStorageListener(), 0, null, $this->getConfig()->getEventQueueName());
    }
}
