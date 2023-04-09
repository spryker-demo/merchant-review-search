<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Yves\MerchantRegistrationPage\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class MerchantRegistrationPageRouterProviderPlugin extends AbstractRouteProviderPlugin
{
    /**
     * @var string
     */
    public const ROUTE_NAME_MERCHANT_REGISTER = 'merchant/register';

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        return $this->addMerchantRegisterRoute($routeCollection);
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addMerchantRegisterRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/merchant/register', 'MerchantRegistrationPage', 'MerchantRegister', 'registerAction');
        $routeCollection->add(static::ROUTE_NAME_MERCHANT_REGISTER, $route);

        return $routeCollection;
    }
}
