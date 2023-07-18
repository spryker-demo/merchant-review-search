<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Communication\GuiTable\ConfigurationProvider;

use Generated\Shared\Transfer\GuiTableConfigurationTransfer;
use Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface;
use Spryker\Shared\GuiTable\GuiTableFactoryInterface;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\MerchantReviewMerchantPortalGuiConfig;

class MerchantReviewGuiTableConfigurationProvider implements MerchantReviewGuiTableConfigurationProviderInterface
{
    /**
     * @var string
     */
    public const COL_KEY_CREATED_AT = 'created_at';

    /**
     * @var string
     */
    public const COL_KEY_NICKNAME = 'nickname';

    /**
     * @var string
     */
    public const COL_KEY_RATING = 'rating';

    /**
     * @var string
     */
    public const COL_KEY_SUMMARY = 'summary';

    /**
     * @var string
     */
    public const COL_KEY_DESCRIPTION = 'description';

    /**
     * @var string
     */
    protected const SEARCH_PLACEHOLDER = 'Search by summary, description, nickname';

    /**
     * @uses \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Communication\Controller\IndexController::tableDataAction()
     *
     * @var string
     */
    protected const DATA_URL = '/merchant-review-merchant-portal-gui/merchant-reviews/table-data';

    /**
     * @var \Spryker\Shared\GuiTable\GuiTableFactoryInterface
     */
    protected GuiTableFactoryInterface $guiTableFactory;

    /**
     * @var \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\MerchantReviewMerchantPortalGuiConfig
     */
    private MerchantReviewMerchantPortalGuiConfig $merchantReviewMerchantPortalGuiConfig;

    /**
     * @param \Spryker\Shared\GuiTable\GuiTableFactoryInterface $guiTableFactory
     * @param \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\MerchantReviewMerchantPortalGuiConfig $merchantReviewMerchantPortalGuiConfig
     */
    public function __construct(
        GuiTableFactoryInterface $guiTableFactory,
        MerchantReviewMerchantPortalGuiConfig $merchantReviewMerchantPortalGuiConfig
    ) {
        $this->guiTableFactory = $guiTableFactory;
        $this->merchantReviewMerchantPortalGuiConfig = $merchantReviewMerchantPortalGuiConfig;
    }

    /**
     * @return \Generated\Shared\Transfer\GuiTableConfigurationTransfer
     */
    public function getConfiguration(): GuiTableConfigurationTransfer
    {
        $guiTableConfigurationBuilder = $this->guiTableFactory->createConfigurationBuilder();

        $guiTableConfigurationBuilder = $this->addColumns($guiTableConfigurationBuilder);

        $guiTableConfigurationBuilder
            ->setDataSourceUrl(static::DATA_URL)
            ->setSearchPlaceholder(static::SEARCH_PLACEHOLDER)
            ->setDefaultPageSize($this->merchantReviewMerchantPortalGuiConfig->getMerchantReviewDefaultPageSize());

        return $guiTableConfigurationBuilder->createConfiguration();
    }

    /**
     * @param \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder
     *
     * @return \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface
     */
    protected function addColumns(GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder): GuiTableConfigurationBuilderInterface
    {
        $guiTableConfigurationBuilder->addColumnText(static::COL_KEY_CREATED_AT, 'Date', true, false)
            ->addColumnText(static::COL_KEY_NICKNAME, 'User', true, false)
            ->addColumnText(static::COL_KEY_RATING, 'Rating', true, false)
            ->addColumnText(static::COL_KEY_SUMMARY, 'Summary', true, false)
            ->addColumnText(static::COL_KEY_DESCRIPTION, 'Description', true, false);

        return $guiTableConfigurationBuilder;
    }
}
