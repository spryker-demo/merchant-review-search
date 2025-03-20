<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewSearch\Reader;

use Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer;
use Generated\Shared\Transfer\RatingAggregationTransfer;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class MerchantRatingAggregationReader implements MerchantRatingAggregationReaderInterface
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
     * @var array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    protected array $ratingAggregationResultFormatterPlugins;

    /**
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $merchantReviewsQueryPlugin
     * @param \Spryker\Client\Search\SearchClientInterface $searchClient
     * @param array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface> $ratingAggregationResultFormatterPlugins
     */
    public function __construct(
        QueryInterface $merchantReviewsQueryPlugin,
        SearchClientInterface $searchClient,
        array $ratingAggregationResultFormatterPlugins
    ) {
        $this->searchQueryPlugin = $merchantReviewsQueryPlugin;
        $this->searchClient = $searchClient;
        $this->ratingAggregationResultFormatterPlugins = $ratingAggregationResultFormatterPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RatingAggregationTransfer
     */
    public function get(MerchantReviewSearchRequestTransfer $merchantReviewSearchRequestTransfer): RatingAggregationTransfer
    {
        $ratingAggregationData = $this->searchClient->search(
            $this->searchQueryPlugin,
            $this->ratingAggregationResultFormatterPlugins,
            $merchantReviewSearchRequestTransfer->getRequestParams(),
        );

        return (new RatingAggregationTransfer())->fromArray($ratingAggregationData, true);
    }
}
