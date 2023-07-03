<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfigurator\Persistence;

use Generated\Shared\Transfer\FrontendConfiguratorTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerDemo\Zed\FrontendConfigurator\Persistence\FrontendConfiguratorPersistenceFactory getFactory()
 */
class FrontendConfiguratorRepository extends AbstractRepository implements FrontendConfiguratorRepositoryInterface
{
    /**
     * @param string $name
     *
     * @return \Generated\Shared\Transfer\FrontendConfiguratorTransfer|null
     */
    public function getFrontendConfigurationByName(string $name): ?FrontendConfiguratorTransfer {
        $frontendConfiguratorEntity = $this->getFactory()
            ->createFrontendConfiguratorQuery()
            ->filterByName($name)
            ->findOneOrCreate();

        return $this->getFactory()
            ->createFrontendConfigurationMapper()
            ->mapFrontendConfiguratorEntityToFrontendConfiguratorTransfer(
                $frontendConfiguratorEntity,
                new FrontendConfiguratorTransfer(),
            );
    }
}
