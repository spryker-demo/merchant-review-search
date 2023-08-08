<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewSearch\Plugin\Elasticsearch\ResultFormatter;

use Elastica\ResultSet;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;
use SprykerDemo\Client\MerchantReviewSearch\Plugin\Elasticsearch\QueryExpander\RatingAggregationQueryExpanderPlugin;

class RatingAggregationResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    /**
     * @var string
     */
    public const NAME = 'ratingAggregation';

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @param \Elastica\ResultSet $searchResult
     * @param array<string, mixed> $requestParameters
     *
     * @return array<int|string, mixed>
     */
    protected function formatSearchResult(ResultSet $searchResult, array $requestParameters): array
    {
        $result = $this->extractRatingAggregation($searchResult);
        $result = $this->sortResults($result);

        return $result;
    }

    /**
     * @param \Elastica\ResultSet $searchResult
     *
     * @return array<int|string, mixed>
     */
    protected function extractRatingAggregation(ResultSet $searchResult): array
    {
        $result = [];
        $aggregation = $searchResult->getAggregation(RatingAggregationQueryExpanderPlugin::AGGREGATION_NAME);

        foreach ($aggregation['buckets'] as $bucket) {
            $result[$bucket['key']] = $bucket['doc_count'];
        }

        return $result;
    }

    /**
     * @param array<int|string, mixed> $result
     *
     * @return array<int|string, mixed>
     */
    protected function sortResults(array $result): array
    {
        krsort($result);

        return $result;
    }
}
