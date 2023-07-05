<?php

namespace SprykerDemo\Service\MerchantReview\Calculator;

use Generated\Shared\Transfer\MerchantReviewSummaryTransfer;
use Generated\Shared\Transfer\RatingAggregationTransfer;
use SprykerDemo\Service\MerchantReview\MerchantReviewConfig;

class MerchantReviewSummaryCalculator
{
    /**
     * @var int
     */
    public const MINIMUM_RATING = 1;

    /**
     * @var int
     */
    public const RATING_PRECISION = 1;

    /**
     * @var \SprykerDemo\Service\MerchantReview\MerchantReviewConfig
     */
    protected MerchantReviewConfig $merchantReviewConfig;

    /**
     * @param \SprykerDemo\Service\MerchantReview\MerchantReviewConfig $merchantReviewConfig
     */
    public function __construct(MerchantReviewConfig $merchantReviewConfig)
    {
        $this->merchantReviewConfig = $merchantReviewConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\RatingAggregationTransfer $ratingAggregationTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewSummaryTransfer
     */
    public function calculate(RatingAggregationTransfer $ratingAggregationTransfer): MerchantReviewSummaryTransfer
    {
        $ratingAggregationTransfer->requireRatingAggregation();

        $ratingAggregation = $ratingAggregationTransfer->getRatingAggregation();
        $totalReview = $this->getTotalReview($ratingAggregation);

        return (new MerchantReviewSummaryTransfer())
            ->setRatingAggregation($this->formatRatingAggregation($ratingAggregation))
            ->setMaximumRating($this->merchantReviewConfig->getMaximumRating())
            ->setAverageRating($this->getAverageRating($ratingAggregation, $totalReview))
            ->setTotalReview($totalReview);
    }

    /**
     * @param array<int> $ratingAggregation
     * @param int $totalReview
     *
     * @return float
     */
    protected function getAverageRating(array $ratingAggregation, int $totalReview): float
    {
        if ($totalReview === 0) {
            return 0.0;
        }

        $totalRating = $this->getTotalRating($ratingAggregation);

        return round($totalRating / $totalReview, static::RATING_PRECISION);
    }

    /**
     * @param array<int> $ratingAggregation
     *
     * @return array<int>
     */
    protected function formatRatingAggregation(array $ratingAggregation): array
    {
        $ratingAggregation = $this->fillRatings($ratingAggregation);
        $ratingAggregation = $this->sortRatings($ratingAggregation);

        return $ratingAggregation;
    }

    /**
     * @param array<int> $ratingAggregation
     *
     * @return array<int>
     */
    protected function fillRatings(array $ratingAggregation): array
    {
        $maximumRating = $this->merchantReviewConfig->getMaximumRating();

        for ($rating = static::MINIMUM_RATING; $rating <= $maximumRating; $rating++) {
            $ratingAggregation[$rating] = array_key_exists($rating, $ratingAggregation) ? $ratingAggregation[$rating] : 0;
        }

        return $ratingAggregation;
    }

    /**
     * @param array<int> $ratingAggregation
     *
     * @return array<int>
     */
    protected function sortRatings(array $ratingAggregation): array
    {
        krsort($ratingAggregation);

        return $ratingAggregation;
    }

    /**
     * @param array<int> $ratingAggregation
     *
     * @return int
     */
    protected function getTotalReview(array $ratingAggregation): int
    {
        return array_sum($ratingAggregation);
    }

    /**
     * @param array<int> $ratingAggregation
     *
     * @return int
     */
    protected function getTotalRating(array $ratingAggregation): int
    {
        $totalRating = 0;

        foreach ($ratingAggregation as $rating => $reviewCount) {
            $totalRating += $reviewCount * $rating;
        }

        return $totalRating;
    }
}
