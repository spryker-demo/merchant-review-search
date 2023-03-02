<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Communication\Controller;

use Generated\Shared\Transfer\MerchantReviewErrorTransfer;
use Generated\Shared\Transfer\MerchantReviewRequestTransfer;
use Generated\Shared\Transfer\MerchantReviewResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;
use SprykerDemo\Shared\MerchantReview\Exception\RatingOutOfRangeException;

/**
 * @method \SprykerDemo\Zed\MerchantReview\Business\MerchantReviewFacadeInterface getFacade()
 * @method \SprykerDemo\Zed\MerchantReview\Communication\MerchantReviewCommunicationFactory getFactory()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewResponseTransfer
     */
    public function submitCustomerReviewAction(
        MerchantReviewRequestTransfer $merchantReviewRequestTransfer
    ): MerchantReviewResponseTransfer {
        $merchantReviewTransfer = $this->getFactory()
            ->createCustomerReviewSubmitMapper()
            ->mapRequestTransfer($merchantReviewRequestTransfer);

        try {
            $merchantReviewTransfer = $this->getFacade()
                ->createMerchantReview($merchantReviewTransfer);

            return (new MerchantReviewResponseTransfer())
                ->setIsSuccess(true)
                ->setMerchantReview($merchantReviewTransfer);
        } catch (RatingOutOfRangeException $exception) {
            return (new MerchantReviewResponseTransfer())
                ->setIsSuccess(false)
                ->addError((new MerchantReviewErrorTransfer())->setMessage($exception->getMessage()));
        }
    }
}
