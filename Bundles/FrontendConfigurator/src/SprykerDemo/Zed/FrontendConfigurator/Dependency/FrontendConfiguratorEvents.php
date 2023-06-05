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
     * - Represents spy_frontend_configurator entity creation.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_SPY_FRONTEND_CONFIGURATOR_CREATE = 'Entity.spy_frontend_configurator.create';

    /**
     * Specification:
     * - Represents spy_frontend_configurator entity changes.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_SPY_FRONTEND_CONFIGURATOR_UPDATE = 'Entity.spy_frontend_configurator.update';

    /**
     * Specification:
     * - Represents spy_frontend_configurator entity deletion.
     *
     * @api
     *
     * @var string
     */
    public const ENTITY_SPY_FRONTEND_CONFIGURATOR_DELETE = 'Entity.spy_frontend_configurator.delete';

    /**
     * Specification:
     * - Resource name, this will use for key generating.
     *
     * @api
     *
     * @var string
     */
    public const FRONTEND_CONFIGURATOR_RESOURCE_NAME = 'spy_frontend_configurator';
}
