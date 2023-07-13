<?php

namespace SprykerDemo\Zed\MerchantReviewMerchantPortalGui;

use Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class MerchantReviewMerchantPortalGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PROPEL_QUERY_MERCHANT_REVIEW = 'PROPEL_QUERY_MERCHANT_REVIEW';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = $this->addMerchantReviewPropelQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMerchantReviewPropelQuery(Container $container): Container
    {
        $container->set(static::PROPEL_QUERY_MERCHANT_REVIEW, $container->factory(function (): SpyMerchantReviewQuery {
            return SpyMerchantReviewQuery::create();
        }));

        return $container;
    }
}
