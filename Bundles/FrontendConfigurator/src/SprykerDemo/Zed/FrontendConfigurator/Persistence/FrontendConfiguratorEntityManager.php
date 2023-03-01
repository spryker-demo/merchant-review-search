<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\FrontendConfigurator\Persistence;

use Generated\Shared\Transfer\ConfigContainerTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \SprykerDemo\Zed\FrontendConfigurator\Persistence\FrontendConfiguratorPersistenceFactory getFactory()
 */
class FrontendConfiguratorEntityManager extends AbstractEntityManager implements FrontendConfiguratorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function saveConfigContainerEntity(
        ConfigContainerTransfer $configContainerTransfer
    ): ConfigContainerTransfer {
        $configContainerEntity = $this->getFactory()
            ->createConfigContainerQuery()
            ->filterByName($configContainerTransfer->getName())
            ->findOneOrCreate();

        $this->getFactory()
            ->createConfigContainerMapper()
            ->mapConfigContainerTransferToConfigContainerEntity(
                $configContainerTransfer,
                $configContainerEntity
            );

        $configContainerEntity->save();

        $this->getFactory()
            ->createConfigContainerMapper()
            ->mapConfigContainerEntityToConfigContainerTransfer(
                $configContainerEntity,
                $configContainerTransfer
            );

        return $configContainerTransfer;
    }
}
