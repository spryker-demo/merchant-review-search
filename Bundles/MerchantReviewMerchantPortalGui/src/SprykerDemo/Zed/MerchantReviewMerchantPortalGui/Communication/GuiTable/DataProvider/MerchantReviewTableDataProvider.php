<?php

namespace SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Communication\GuiTable\DataProvider;

use Generated\Shared\Transfer\GuiTableDataRequestTransfer;
use Generated\Shared\Transfer\GuiTableDataResponseTransfer;
use Generated\Shared\Transfer\GuiTableRowDataResponseTransfer;
use Generated\Shared\Transfer\MerchantReviewTableCriteriaTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Spryker\Shared\GuiTable\DataProvider\AbstractGuiTableDataProvider;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;
use Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Communication\GuiTable\ConfigurationProvider\MerchantReviewGuiTableConfigurationProvider;
use SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\MerchantReviewMerchantPortalGuiRepositoryInterface;

class MerchantReviewTableDataProvider extends AbstractGuiTableDataProvider
{
    /**
     * @var \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\MerchantReviewMerchantPortalGuiRepositoryInterface
     */
    protected MerchantReviewMerchantPortalGuiRepositoryInterface $merchantReviewMerchantPortalGuiRepository;

    /**
     * @var \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected LocaleFacadeInterface $localeFacade;

    /**
     * @var \Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface
     */
    protected MerchantUserFacadeInterface $merchantUserFacade;

    /**
     * @param \SprykerDemo\Zed\MerchantReviewMerchantPortalGui\Persistence\MerchantReviewMerchantPortalGuiRepositoryInterface $merchantReviewMerchantPortalGuiRepository
     * @param \Spryker\Zed\Locale\Business\LocaleFacadeInterface $localeFacade
     * @param \Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface $merchantUserFacade
     */
    public function __construct(
        MerchantReviewMerchantPortalGuiRepositoryInterface    $merchantReviewMerchantPortalGuiRepository,
        LocaleFacadeInterface $localeFacade,
        MerchantUserFacadeInterface $merchantUserFacade,
    ) {
        $this->merchantReviewMerchantPortalGuiRepository = $merchantReviewMerchantPortalGuiRepository;
        $this->localeFacade = $localeFacade;
        $this->merchantUserFacade = $merchantUserFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\GuiTableDataRequestTransfer $guiTableDataRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected function createCriteria(GuiTableDataRequestTransfer $guiTableDataRequestTransfer): AbstractTransfer
    {
        return (new MerchantReviewTableCriteriaTransfer())
            ->setLocale($this->localeFacade->getCurrentLocale())
            ->setIdMerchant($this->merchantUserFacade->getCurrentMerchantUser()->getIdMerchant());
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTableCriteriaTransfer $criteriaTransfer
     *
     * @return \Generated\Shared\Transfer\GuiTableDataResponseTransfer
     */
    protected function fetchData(AbstractTransfer $criteriaTransfer): GuiTableDataResponseTransfer
    {
        $merchantReviewCollectionTransfer = $this->merchantReviewMerchantPortalGuiRepository
            ->getMerchantReviewTableData($criteriaTransfer);
        $guiTableDataResponseTransfer = new GuiTableDataResponseTransfer();

        foreach ($merchantReviewCollectionTransfer->getMerchantReviews() as $merchantReviewTransfer) {
            $responseData = [
                MerchantReviewTransfer::ID_MERCHANT_REVIEW => $merchantReviewTransfer->getIdMerchantReview(),
                MerchantReviewGuiTableConfigurationProvider::COL_KEY_CREATED_AT => $merchantReviewTransfer->getCreatedAt(),
                MerchantReviewGuiTableConfigurationProvider::COL_KEY_NICKNAME => $merchantReviewTransfer->getNickname(),
                MerchantReviewGuiTableConfigurationProvider::COL_KEY_RATING => $merchantReviewTransfer->getRating(),
                MerchantReviewGuiTableConfigurationProvider::COL_KEY_SUMMARY => $merchantReviewTransfer->getSummary(),
                MerchantReviewGuiTableConfigurationProvider::COL_KEY_DESCRIPTION => $merchantReviewTransfer->getDescription(),
            ];

            $guiTableDataResponseTransfer->addRow((new GuiTableRowDataResponseTransfer())->setResponseData($responseData));
        }

        $paginationTransfer = $merchantReviewCollectionTransfer->getPagination();

        if (!$paginationTransfer) {
            return $guiTableDataResponseTransfer;
        }

        return $guiTableDataResponseTransfer
            ->setPage($paginationTransfer->getPage())
            ->setPageSize($paginationTransfer->getMaxPerPage())
            ->setTotal($paginationTransfer->getNbResults());
    }
}
