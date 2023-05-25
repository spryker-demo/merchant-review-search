<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewSearch\Reader;

use Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class MerchantReviewSearchReader implements MerchantReviewSearchReaderInterface
{
    /**
     * @var \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected $searchQueryPlugin;

    /**
     * @var \Spryker\Client\Search\SearchClientInterface
     */
    protected $searchClient;

    /**
     * @var array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    protected $searchResultFormatterPlugins;

    /**
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $merchantReviewsQueryPlugin
     * @param \Spryker\Client\Search\SearchClientInterface $searchClient
     * @param array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface> $searchResultFormatterPlugins
     */
    public function __construct(
        QueryInterface $merchantReviewsQueryPlugin,
        SearchClientInterface $searchClient,
        array $searchResultFormatterPlugins
    ) {
        $this->searchQueryPlugin = $merchantReviewsQueryPlugin;
        $this->searchClient = $searchClient;
        $this->searchResultFormatterPlugins = $searchResultFormatterPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer
     *
     * @return \Elastica\ResultSet|mixed|array
     */
    public function findMerchantReviews(MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer): mixed
    {
        return $this->searchClient->search(
            $this->searchQueryPlugin,
            $this->searchResultFormatterPlugins,
            $merchantReviewSearchRequestTransfer->getRequestParameters(),
        );
    }

    /**
     * @return \Elastica\ResultSet|mixed|array
     */
    public function searchMerchantReviews()
    {
        return $this->searchClient->search(
            $this->searchQueryPlugin,
            $this->searchResultFormatterPlugins,
        );
    }
}
