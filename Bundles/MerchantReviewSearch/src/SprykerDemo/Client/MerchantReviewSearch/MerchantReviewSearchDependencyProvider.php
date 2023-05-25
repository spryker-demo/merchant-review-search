<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewSearch;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Search\Plugin\Config\PaginationConfigBuilder;

/**
 * @method \SprykerDemo\Client\MerchantReviewSearch\MerchantReviewSearchConfig getConfig()
 */
class MerchantReviewSearchDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_SEARCH = 'CLIENT_SEARCH';

    /**
     * @var string
     */
    public const MERCHANT_REVIEWS_SEARCH_RESULT_FORMATTER_PLUGINS = 'MERCHANT_REVIEWS_SEARCH_RESULT_FORMATTER_PLUGINS';

    /**
     * @var string
     */
    public const MERCHANT_REVIEWS_QUERY_EXPANDER_PLUGINS = 'MERCHANT_REVIEWS_QUERY_EXPANDER_PLUGINS';

    /**
     * @var string
     */
    public const PAGINATION_CONFIG_BUILDER_PLUGIN = 'PAGINATION_CONFIG_BUILDER_PLUGIN';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);
        $container = $this->addSearchClient($container);
        $container = $this->addMerchantReviewsSearchResultFormatterPlugins($container);
        $container = $this->addPaginationConfigBuilderPlugin($container);
        $container = $this->addMerchantReviewsQueryExpanderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addSearchClient(Container $container): Container
    {
        $container->set(static::CLIENT_SEARCH, function (Container $container) {
            return $container->getLocator()->search()->client();
        });

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addMerchantReviewsSearchResultFormatterPlugins(Container $container): Container
    {
        $container->set(static::MERCHANT_REVIEWS_SEARCH_RESULT_FORMATTER_PLUGINS, function () {
            return $this->getMerchantReviewsSearchResultFormatterPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    public function getMerchantReviewsSearchResultFormatterPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addMerchantReviewsQueryExpanderPlugins(Container $container): Container
    {
        $container->set(static::MERCHANT_REVIEWS_QUERY_EXPANDER_PLUGINS, function () {
            return $this->getMerchantReviewsQueryExpanderPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    protected function getMerchantReviewsQueryExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPaginationConfigBuilderPlugin(Container $container): Container
    {
        $container->set(static::PAGINATION_CONFIG_BUILDER_PLUGIN, function (Container $container) {
            return new PaginationConfigBuilder();
        });

        return $container;
    }
}
