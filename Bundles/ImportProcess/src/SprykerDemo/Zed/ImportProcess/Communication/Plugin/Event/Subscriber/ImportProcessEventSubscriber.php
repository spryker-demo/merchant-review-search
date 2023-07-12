<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcess\Communication\Plugin\Event\Subscriber;

use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerDemo\Zed\ImportProcess\Communication\Plugin\Event\Listener\ImportProcessCreateListener;
use SprykerDemo\Zed\ImportProcess\ImportProcessEvents;

/**
 * @method \SprykerDemo\Zed\ImportProcess\ImportProcessConfig getConfig()
 */
class ImportProcessEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        $eventCollection->addListenerQueued(
            ImportProcessEvents::ENTITY_IMPORT_PROCESS_CREATE,
            new ImportProcessCreateListener(),
            0,
            null,
            $this->getConfig()->getImportProcessQueueName(),
        );

        return $eventCollection;
    }
}
