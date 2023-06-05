<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\FrontendConfigurator\Persistence;

use Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfigurator;
use Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfiguratorQuery;
use SprykerDemo\Zed\FrontendConfigurator\FrontendConfiguratorDependencyProvider;
use SprykerDemo\Zed\FrontendConfigurator\Persistence\Mapper\ConfigContainerMapper;
use SprykerDemo\Zed\FrontendConfigurator\Persistence\Mapper\ConfigContainerMapperInterface;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \SprykerDemo\Zed\FrontendConfigurator\FrontendConfiguratorConfig getConfig()
 */
class FrontendConfiguratorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\FrontendConfigurator\Persistence\SpyFrontendConfiguratorQuery
     */
    public function createFrontendConfiguratorQuery(): SpyFrontendConfiguratorQuery
    {
        return SpyFrontendConfiguratorQuery::create();
    }

    /**
     * @return \Pyz\Zed\FrontendConfigurator\Persistence\Mapper\ConfigContainerMapperInterface
     */
    public function createConfigContainerMapper(): ConfigContainerMapperInterface
    {
        return new ConfigContainerMapper($this->getUtilEncodingService());
    }

    /**
     * @return \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    public function getUtilEncodingService(): UtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(FrontendConfiguratorDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
