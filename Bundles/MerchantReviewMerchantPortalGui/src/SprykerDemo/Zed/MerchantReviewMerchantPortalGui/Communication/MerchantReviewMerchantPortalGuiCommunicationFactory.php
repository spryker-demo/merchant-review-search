<?php

namespace SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Communication;

use Spryker\Shared\GuiTable\GuiTableFactoryInterface;
use Spryker\Shared\GuiTable\Http\GuiTableDataRequestExecutorInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;
use Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Communication\GuiTable\ConfigurationProvider\MerchantReviewGuiTableConfigurationProvider;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Communication\GuiTable\ConfigurationProvider\MerchantReviewGuiTableConfigurationProviderInterface;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Communication\GuiTable\DataProvider\MerchantReviewTableDataProvider;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\MerchantReviewMerchantPortalGuiDependencyProvider;

/**
 * @method \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\MerchantReviewMerchantPortalGuiConfig getConfig()
 * @method \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\MerchantReviewMerchantPortalGuiRepositoryInterface getRepository()
 */
class MerchantReviewMerchantPortalGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Communication\GuiTable\ConfigurationProvider\MerchantReviewGuiTableConfigurationProviderInterface
     */
    public function createMerchantReviewGuiTableConfigurationProvider(): MerchantReviewGuiTableConfigurationProviderInterface
    {
        return new MerchantReviewGuiTableConfigurationProvider(
            $this->getGuiTableFactory(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Communication\GuiTable\DataProvider\MerchantReviewTableDataProvider
     */
    public function createMerchantReviewTableDataProvider(): MerchantReviewTableDataProvider
    {
        return new MerchantReviewTableDataProvider(
            $this->getRepository(),
            $this->getLocaleFacade(),
            $this->getMerchantUserFacade()
        );
    }

    /**
     * @return \Spryker\Shared\GuiTable\GuiTableFactoryInterface
     */
    public function getGuiTableFactory(): GuiTableFactoryInterface
    {
        return $this->getProvidedDependency(MerchantReviewMerchantPortalGuiDependencyProvider::SERVICE_GUI_TABLE_FACTORY);
    }

    /**
     * @return \Spryker\Shared\GuiTable\Http\GuiTableDataRequestExecutorInterface
     */
    public function getGuiTableHttpDataRequestExecutor(): GuiTableDataRequestExecutorInterface
    {
        return $this->getProvidedDependency(MerchantReviewMerchantPortalGuiDependencyProvider::SERVICE_GUI_TABLE_HTTP_DATA_REQUEST_EXECUTOR);
    }

    /**
     * @return \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    public function getLocaleFacade(): LocaleFacadeInterface
    {
        return $this->getProvidedDependency(MerchantReviewMerchantPortalGuiDependencyProvider::FACADE_LOCALE);
    }

    /**
     * @return \Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface
     */
    public function getMerchantUserFacade(): MerchantUserFacadeInterface
    {
        return $this->getProvidedDependency(MerchantReviewMerchantPortalGuiDependencyProvider::FACADE_MERCHANT_USER);
    }
}
