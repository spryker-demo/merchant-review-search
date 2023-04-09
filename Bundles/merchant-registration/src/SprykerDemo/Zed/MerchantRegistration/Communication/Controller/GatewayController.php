<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\MerchantRegistration\Communication\Controller;

use Generated\Shared\Transfer\MerchantCollectionTransfer;
use Generated\Shared\Transfer\MerchantCriteriaTransfer;
use Generated\Shared\Transfer\MerchantResponseTransfer;
use Generated\Shared\Transfer\MerchantTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \SprykerDemo\Zed\MerchantRegistration\Business\MerchantRegistrationFacadeInterface getFacade()
 * @method \SprykerDemo\Zed\MerchantRegistration\Communication\MerchantRegistrationCommunicationFactory getFactory()
 * @method \SprykerDemo\Zed\MerchantRegistration\Persistence\MerchantRegistrationRepositoryInterface getRepository()
 *
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantResponseTransfer
     */
    public function registerMerchantAction(MerchantTransfer $merchantTransfer): MerchantResponseTransfer
    {
        return $this->getFacade()->merchantRegister($merchantTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantCriteriaTransfer $merchantCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantTransfer|null
     */
    public function merchantExistsAction(MerchantCriteriaTransfer $merchantCriteriaTransfer): MerchantTransfer
    {
        $merchantTransfer = $this->getFacade()->merchantExists($merchantCriteriaTransfer);

        if ($merchantTransfer === null) {
            return new MerchantTransfer();
        }

        return $merchantTransfer;
    }
}
