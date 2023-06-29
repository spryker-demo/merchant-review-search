<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfigurator\Persistence;

use Generated\Shared\Transfer\ConfigContainerTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerDemo\Zed\FrontendConfigurator\Persistence\FrontendConfiguratorPersistenceFactory getFactory()
 */
class FrontendConfiguratorRepository extends AbstractRepository implements FrontendConfiguratorRepositoryInterface
{
    /**
     * @param string $name
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer|null
     */
    public function getConfigContainerByName(
        string $name
    ): ?ConfigContainerTransfer {
        $configContainerEntity = $this->getFactory()
            ->createFrontendConfiguratorQuery()
            ->filterByName($name)
            ->findOneOrCreate();

        return $this->getFactory()
            ->createConfigContainerMapper()
            ->mapConfigContainerEntityToConfigContainerTransfer(
                $configContainerEntity,
                new ConfigContainerTransfer(),
            );
    }
}
