<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Communication\Controller\Mapper;

use Generated\Shared\Transfer\MerchantReviewRequestTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class CustomerReviewSubmitMapper implements CustomerReviewSubmitMapperInterface
{
    /**
     * @var \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected LocaleFacadeInterface $localeFacade;

    /**
     * @param \Spryker\Zed\Locale\Business\LocaleFacadeInterface $localeFacade
     */
    public function __construct(LocaleFacadeInterface $localeFacade)
    {
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function mapRequestTransfer(MerchantReviewRequestTransfer $merchantReviewRequestTransfer): MerchantReviewTransfer
    {
        $this->assertMerchantReviewRequestTransfer($merchantReviewRequestTransfer);

        $merchantReviewTransfer = new MerchantReviewTransfer();

        $merchantReviewTransfer
            ->fromArray($merchantReviewRequestTransfer->modifiedToArray(), true)
            ->setFkMerchant($merchantReviewRequestTransfer->getIdMerchant())
            ->setFkLocale($this->getIdLocale($merchantReviewRequestTransfer));

        return $merchantReviewTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @return int|null
     */
    protected function getIdLocale(MerchantReviewRequestTransfer $merchantReviewRequestTransfer): ?int
    {
        $localeName = $merchantReviewRequestTransfer->getLocaleName();

        if (!$localeName) {
            return null;
        }

        return $this->localeFacade->getLocale($localeName)->getIdLocale();
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @return void
     */
    protected function assertMerchantReviewRequestTransfer(MerchantReviewRequestTransfer $merchantReviewRequestTransfer): void
    {
        $merchantReviewRequestTransfer
            ->requireIdMerchant()
            ->requireLocaleName();
    }
}
