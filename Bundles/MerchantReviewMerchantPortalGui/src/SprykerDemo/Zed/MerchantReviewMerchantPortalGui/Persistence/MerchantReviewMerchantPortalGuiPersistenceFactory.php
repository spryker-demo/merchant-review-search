<?php

namespace SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence;

use Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\MerchantReviewMerchantPortalGuiDependencyProvider;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\Propel\MerchantReviewTableDataMapper;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\Propel\PropelModelPagerMapper;

class MerchantReviewMerchantPortalGuiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getMerchantReviewPropelQuery(): SpyMerchantReviewQuery
    {
        return $this->getProvidedDependency(MerchantReviewMerchantPortalGuiDependencyProvider::PROPEL_QUERY_MERCHANT_REVIEW);
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\Propel\PropelModelPagerMapper
     */
    public function createPropelModelPagerMapper(): PropelModelPagerMapper
    {
        return new PropelModelPagerMapper();
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\Propel\MerchantReviewTableDataMapper
     */
    public function createMerchantReviewTableDataMapper(): MerchantReviewTableDataMapper
    {
        return new MerchantReviewTableDataMapper();
    }
}
