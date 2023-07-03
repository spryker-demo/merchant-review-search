<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfigurator\Persistence;

use Generated\Shared\Transfer\FrontendConfiguratorTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \SprykerDemo\Zed\FrontendConfigurator\Persistence\FrontendConfiguratorPersistenceFactory getFactory()
 */
class FrontendConfiguratorEntityManager extends AbstractEntityManager implements FrontendConfiguratorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\FrontendConfiguratorTransfer $frontendConfiguratorTransfer
     *
     * @return void
     */
    public function saveFrontendConfiguration(
        FrontendConfiguratorTransfer $frontendConfiguratorTransfer
    ): void
    {
        $frontendConfiguratorEntity = $this->getFactory()
            ->createFrontendConfiguratorQuery()
            ->filterByName($frontendConfiguratorTransfer->getName())
            ->findOneOrCreate();

        $this->getFactory()
            ->createFrontendConfigurationMapper()
            ->mapFrontendConfiguratorTransferToFrontendConfiguratorEntity(
                $frontendConfiguratorTransfer,
                $frontendConfiguratorEntity,
            );

        $frontendConfiguratorEntity->save();
    }
}
