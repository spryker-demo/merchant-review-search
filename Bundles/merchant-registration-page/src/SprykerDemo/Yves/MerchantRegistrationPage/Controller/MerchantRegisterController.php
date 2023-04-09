<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Yves\MerchantRegistrationPage\Controller;

use Generated\Shared\Transfer\MerchantProfileAddressTransfer;
use Generated\Shared\Transfer\MerchantProfileTransfer;
use Generated\Shared\Transfer\MerchantRegistrationFormDataTransfer;
use Generated\Shared\Transfer\MerchantResponseTransfer;
use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\StoreRelationTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerDemo\Yves\MerchantRegistrationPage\MerchantRegistrationPageFactory getFactory()
 */
class MerchantRegisterController extends AbstractController
{
    /**
     * @var string
     */
    public const COMPANY_AUTHORIZATION_SUCCESS = 'company.account.authorization.success';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Spryker\Yves\Kernel\View\View|\Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    public function registerAction(Request $request)
    {
        $response = $this->executeRegisterAction($request);

        if (!is_array($response)) {
            return $response;
        }

        return $this->view($response, [], '@MerchantRegistrationPage/views/merchant-register/merchant-register.twig');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    protected function executeRegisterAction(Request $request)
    {
        $dataProvider = $this->getFactory()
            ->createMerchantFormFactory()
            ->createMerchantRegisterFormDataProvider();

        $merchantRegisterForm = $this
            ->getFactory()
            ->createMerchantFormFactory()
            ->getMerchantRegisterForm(
                $dataProvider->getData(),
                $dataProvider->getOptions(),
            )
            ->handleRequest($request);

        if ($merchantRegisterForm->isSubmitted() && $merchantRegisterForm->isValid()) {
            $merchantResponseTransfer = $this->registerMerchant($merchantRegisterForm->getData());

            if ($merchantResponseTransfer->getIsSuccess()) {
                $this->addSuccessMessages($merchantResponseTransfer);

                return $this->redirectResponseInternal('home');
            }

            foreach ($merchantResponseTransfer->getErrors() as $responseMessage) {
                $this->addErrorMessage($responseMessage->getMessage());
            }
        }

        return [
            'merchantRegisterForm' => $merchantRegisterForm->createView(),
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantResponseTransfer $merchantResponseTransfer
     *
     * @return void
     */
    protected function addSuccessMessages(MerchantResponseTransfer $merchantResponseTransfer): void
    {
        if (!$merchantResponseTransfer->getErrors()->count()) {
            $this->addSuccessMessage(static::COMPANY_AUTHORIZATION_SUCCESS);

            return;
        }

        foreach ($merchantResponseTransfer->getErrors() as $responseMessageTransfer) {
            $this->addErrorMessage($responseMessageTransfer->getMessage());
        }
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantRegistrationFormDataTransfer $merchantRegistrationFormDataTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantResponseTransfer
     */
    protected function registerMerchant(MerchantRegistrationFormDataTransfer $merchantRegistrationFormDataTransfer): MerchantResponseTransfer
    {
        $merchantProfileTransfer = $this->getMerchantProfileTransfer($merchantRegistrationFormDataTransfer);

        $merchantProfileAddressTransfer = $this->getMerchantProfileAddressTransfer($merchantRegistrationFormDataTransfer);

        $merchantProfileTransfer->addAddress($merchantProfileAddressTransfer);

        $currentStore = $this->getFactory()->getStoreClient()->getCurrentStore();
        $storeRelationTransfer = new StoreRelationTransfer();
        $storeRelationTransfer->addStores($currentStore);

        $merchantTransfer = $this->getMerchantTransfer($merchantRegistrationFormDataTransfer, $storeRelationTransfer, $merchantProfileTransfer);

        return $this->getFactory()->getMerchantRegistrationClient()->registerMerchant($merchantTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantRegistrationFormDataTransfer $merchantRegistrationFormDataTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantProfileTransfer
     */
    protected function getMerchantProfileTransfer(MerchantRegistrationFormDataTransfer $merchantRegistrationFormDataTransfer): MerchantProfileTransfer
    {
        $merchantProfileTransfer = new MerchantProfileTransfer();
        $merchantProfileTransfer->setContactPersonFirstName($merchantRegistrationFormDataTransfer->getcontactPersonFirstName());
        $merchantProfileTransfer->setContactPersonLastName($merchantRegistrationFormDataTransfer->getcontactPersonLastName());
        $merchantProfileTransfer->setContactPersonPhone($merchantRegistrationFormDataTransfer->getcontactPersonPhone());
        $merchantProfileTransfer->setContactPersonRole($merchantRegistrationFormDataTransfer->getcontactPersonRole());
        $merchantProfileTransfer->setContactPersonTitle($merchantRegistrationFormDataTransfer->getcontactPersonTitle());

        return $merchantProfileTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantRegistrationFormDataTransfer $merchantRegistrationFormDataTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantProfileAddressTransfer
     */
    protected function getMerchantProfileAddressTransfer(
        MerchantRegistrationFormDataTransfer $merchantRegistrationFormDataTransfer
    ): MerchantProfileAddressTransfer {
        $merchantProfileAddressTransfer = new MerchantProfileAddressTransfer();
        $merchantProfileAddressTransfer->setEmail($merchantRegistrationFormDataTransfer->getemail());
        $merchantProfileAddressTransfer->setAddress1($merchantRegistrationFormDataTransfer->getaddress1());
        $merchantProfileAddressTransfer->setAddress2($merchantRegistrationFormDataTransfer->getaddress2());
        $merchantProfileAddressTransfer->setCity($merchantRegistrationFormDataTransfer->getcity());
        $merchantProfileAddressTransfer->setCountryName($merchantRegistrationFormDataTransfer->getiso2Code());
        $merchantProfileAddressTransfer->setZipCode($merchantRegistrationFormDataTransfer->getzipCode());

        return $merchantProfileAddressTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantRegistrationFormDataTransfer $merchantRegistrationFormDataTransfer
     * @param \Generated\Shared\Transfer\StoreRelationTransfer $storeRelationTransfer
     * @param \Generated\Shared\Transfer\MerchantProfileTransfer $merchantProfileTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantTransfer
     */
    private function getMerchantTransfer(
        MerchantRegistrationFormDataTransfer $merchantRegistrationFormDataTransfer,
        StoreRelationTransfer $storeRelationTransfer,
        MerchantProfileTransfer $merchantProfileTransfer
    ): MerchantTransfer {
        $merchantTransfer = new MerchantTransfer();
        $merchantTransfer->setEmail($merchantRegistrationFormDataTransfer->getEmail());
        $merchantTransfer->setIsActive(false);
        $merchantTransfer->setRegistrationNumber($merchantRegistrationFormDataTransfer->getRegistrationNumber());
        $merchantTransfer->setName($merchantRegistrationFormDataTransfer->getCompanyName());
        $merchantTransfer->setStatus('waiting-for-approval');
        $merchantTransfer->setStoreRelation($storeRelationTransfer);
        $merchantTransfer->setMerchantProfile($merchantProfileTransfer);
        $merchantTransfer->setMerchantReference(uniqid('MER', true));
        $merchantTransfer->setPassword($merchantRegistrationFormDataTransfer->getPassword());

        return $merchantTransfer;
    }
}
