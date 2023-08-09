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
    protected QueryInterface $searchQueryPlugin;

    /**
     * @var \Spryker\Client\Search\SearchClientInterface
     */
    protected SearchClientInterface $searchClient;

    /**
     * @var array<\Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    protected array $searchResultFormatterPlugins;

    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $merchantReviewsQueryPlugin
     * @param \Spryker\Client\Search\SearchClientInterface $searchClient
     * @param array<\Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface> $searchResultFormatterPlugins
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
     * @return array<string, mixed>
     */
    public function search(MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer): array
    {
        return $this->searchClient->search(
            $this->searchQueryPlugin,
            $this->searchResultFormatterPlugins,
            $merchantReviewSearchRequestTransfer->getRequestParams(),
        );
    }
}
