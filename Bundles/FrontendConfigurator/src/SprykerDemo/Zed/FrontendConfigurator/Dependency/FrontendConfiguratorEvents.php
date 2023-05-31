<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfigurator\Dependency;

interface FrontendConfiguratorEvents
{
    public const FRONTEND_CONFIGURATOR_PUBLISH = 'FrontendConfigurator.publish';

    /**
     * Specification:
     * - Represents pyz_config_container entity creation.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_PYZ_CONFIG_CONTAINER_CREATE = 'Entity.pyz_config_container.create';

    /**
     * Specification:
     * - Represents pyz_config_container entity changes.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_PYZ_CONFIG_CONTAINER_UPDATE = 'Entity.pyz_config_container.update';

    /**
     * Specification:
     * - Represents pyz_config_container entity deletion.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_PYZ_CONFIG_CONTAINER_DELETE = 'Entity.pyz_config_container.delete';

    /**
     * Specification:
     * - Resource name, this will use for key generating.
     *
     * @api
     *
     * @var string
     */
    public const FRONTEND_CONFIGURATOR_RESOURCE_NAME = 'pyz_config_container';
}
