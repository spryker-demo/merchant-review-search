<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\MerchantReviewSearch\Plugin\Elasticsearch\ResultFormatter;

use Elastica\ResultSet;
use Generated\Shared\Search\MerchantReviewIndexMap;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class MerchantReviewsResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    /**
     * @var string
     */
    public const NAME = 'merchantReviews';

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
     * @return array<\Generated\Shared\Transfer\MerchantReviewTransfer>
     */
    public function formatSearchResult(ResultSet $searchResult, array $requestParameters = []): array
    {
        $merchantReviews = [];
        foreach ($searchResult->getResults() as $document) {
            $merchantReviews[] = $this->mapMerchantReviewDocument($document->getSource()[MerchantReviewIndexMap::SEARCH_RESULT_DATA]);
        }

        return $merchantReviews;
    }

    /**
     * @param array<string, mixed> $searchResultData
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    protected function mapMerchantReviewDocument(array $searchResultData): MerchantReviewTransfer
    {
        return (new MerchantReviewTransfer())->fromArray($searchResultData, true);
    }
}
