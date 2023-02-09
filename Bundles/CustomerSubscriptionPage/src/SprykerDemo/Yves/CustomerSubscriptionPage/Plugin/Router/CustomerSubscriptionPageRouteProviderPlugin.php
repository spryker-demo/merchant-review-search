<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Yves\CustomerSubscriptionPage\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class CustomerSubscriptionPageRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    /**
     * @var string
     */
    public const ROUTE_CANCEL_SUBSCRIPTION = 'customer/subscription/cancel';

    /**
     * @var string
     */
    public const ROUTE_SUBSCRIPTION = 'customer/subscription';

    /**
     * Specification:
     * - Adds Routes to the RouteCollection.
     *
     * @api
     *
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addCancelSubscriptionRoute($routeCollection);
        $routeCollection = $this->addSubscriptionRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addCancelSubscriptionRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildPostRoute('/customer/subscription/cancel', 'CustomerSubscriptionPage', 'Subscription', 'cancelAction');
        $routeCollection->add(static::ROUTE_CANCEL_SUBSCRIPTION, $route);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addSubscriptionRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildGetRoute('/customer/subscription', 'CustomerSubscriptionPage', 'Subscription', 'indexAction');
        $routeCollection->add(static::ROUTE_SUBSCRIPTION, $route);

        return $routeCollection;
    }
}
