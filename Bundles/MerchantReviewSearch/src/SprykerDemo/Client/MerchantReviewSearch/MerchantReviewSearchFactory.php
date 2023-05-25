<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewSearch;

use Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Search\Dependency\Plugin\PaginationConfigBuilderInterface;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use SprykerDemo\Client\MerchantReviewSearch\Pagination\PaginationExpander;
use SprykerDemo\Client\MerchantReviewSearch\Pagination\PaginationExpanderInterface;
use SprykerDemo\Client\MerchantReviewSearch\Plugin\Elasticsearch\Query\MerchantReviewsQueryPlugin;
use SprykerDemo\Client\MerchantReviewSearch\Reader\MerchantReviewSearchReader;
use SprykerDemo\Client\MerchantReviewSearch\Reader\MerchantReviewSearchReaderInterface;

class MerchantReviewSearchFactory extends AbstractFactory
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer
     *
     * @return \SprykerDemo\Client\MerchantReviewSearch\Reader\MerchantReviewSearchReaderInterface
     */
    public function createMerchantReviewSearchReader(
        MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer
    ): MerchantReviewSearchReaderInterface {
        return new MerchantReviewSearchReader(
            $this->createMerchantReviewsQueryPlugin($merchantReviewSearchRequestTransfer),
            $this->getSearchClient(),
            $this->getMerchantReviewsSearchResultFormatterPlugins(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function createMerchantReviewsQueryPlugin(
        MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer
    ): QueryInterface {
        $merchantReviewsQueryPlugin = new MerchantReviewsQueryPlugin($merchantReviewSearchRequestTransfer);

        return $this->getSearchClient()->expandQuery(
            $merchantReviewsQueryPlugin,
            $this->getMerchantReviewsQueryExpanderPlugins(),
            $merchantReviewSearchRequestTransfer->getRequestParameters(),
        );
    }

    /**
     * @return \Spryker\Client\Search\SearchClientInterface
     */
    public function getSearchClient(): SearchClientInterface
    {
        return $this->getProvidedDependency(MerchantReviewSearchDependencyProvider::CLIENT_SEARCH);
    }

    /**
     * @return array<\Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    protected function getMerchantReviewsQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(
            MerchantReviewSearchDependencyProvider::MERCHANT_REVIEWS_QUERY_EXPANDER_PLUGINS,
        );
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    public function getMerchantReviewsSearchResultFormatterPlugins(): array
    {
        return $this->getProvidedDependency(
            MerchantReviewSearchDependencyProvider::MERCHANT_REVIEWS_SEARCH_RESULT_FORMATTER_PLUGINS,
        );
    }

    public function createPaginationExpander(): PaginationExpanderInterface
    {
        return new PaginationExpander($this->getPaginationConfigBuilder());
    }

        /**
         * @return \Spryker\Client\Search\Dependency\Plugin\PaginationConfigBuilderInterface
         */
    public function getPaginationConfigBuilder(): PaginationConfigBuilderInterface
    {
        $paginationConfigBuilder = $this->getProvidedDependency(MerchantReviewSearchDependencyProvider::PAGINATION_CONFIG_BUILDER_PLUGIN);
        $paginationConfigBuilder->setPagination($this->getConfig()->getPaginationConfig());

        return $paginationConfigBuilder;
    }
}
