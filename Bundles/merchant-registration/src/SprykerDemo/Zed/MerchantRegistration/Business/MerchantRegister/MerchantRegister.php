<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\MerchantRegistration\Business\MerchantRegister;

use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\MerchantResponseTransfer;
use Generated\Shared\Transfer\MerchantTransfer;
use Generated\Shared\Transfer\MerchantUserTransfer;
use Generated\Shared\Transfer\StateMachineProcessTransfer;
use Generated\Shared\Transfer\StoreRelationTransfer;
use Generated\Shared\Transfer\UrlTransfer;
use Generated\Shared\Transfer\UserTransfer;
use Pyz\Zed\DemoStateMachine\DemoStateMachineConfig;
use Spryker\Zed\Merchant\Business\MerchantFacadeInterface;
use SprykerDemo\Zed\MerchantRegistration\Communication\Plugin\Mail\MerchantRegistrationMailTypePlugin;
use Spryker\Service\UtilText\UtilTextServiceInterface;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;
use Spryker\Zed\Mail\Business\MailFacadeInterface;
use Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface;
use Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use Spryker\Zed\User\Business\UserFacadeInterface;
use SprykerDemo\Zed\MerchantRegistration\MerchantRegistrationConfig;

class MerchantRegister
{
    /**
     * @uses \Orm\Zed\User\Persistence\Map\SpyUserTableMap::COL_STATUS_ACTIVE
     *
     * @var string
     */
    protected const USER_STATUS_ACTIVE = 'active';

    /**
     * @var \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected LocaleFacadeInterface $localeFacade;

    /**
     * @var \Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface
     */
    protected MerchantUserFacadeInterface $merchantUserFacade;

    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected StoreFacadeInterface $storeFacade;

    /**
     * @var \Spryker\Zed\User\Business\UserFacadeInterface
     */
    protected UserFacadeInterface $userFacade;

    /**
     * @var \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface
     */
    protected StateMachineFacadeInterface $stateMachineFacade;

    /**
     * @var \Spryker\Zed\Mail\Business\MailFacadeInterface
     */
    protected MailFacadeInterface $mailFacade;

    /**
     * @var \Spryker\Service\UtilText\UtilTextServiceInterface
     */
    protected UtilTextServiceInterface $utilTextService;

    /**
     * @var \Spryker\Zed\Merchant\Business\MerchantFacadeInterface
     */
    protected MerchantFacadeInterface $merchantFacade;

    /**
     * @param \Spryker\Zed\Locale\Business\LocaleFacadeInterface $localeFacade
     * @param \Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface $merchantUserFacade
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     * @param \Spryker\Zed\User\Business\UserFacadeInterface $userFacade
     * @param \Spryker\Zed\StateMachine\Business\StateMachineFacadeInterface $stateMachineFacade
     * @param \Spryker\Zed\Mail\Business\MailFacadeInterface $mailFacade
     * @param \Spryker\Service\UtilText\UtilTextServiceInterface $utilTextService
     * @param \Spryker\Zed\Merchant\Business\MerchantFacadeInterface $merchantFacade
     */
    public function __construct(
        LocaleFacadeInterface $localeFacade,
        MerchantUserFacadeInterface $merchantUserFacade,
        StoreFacadeInterface $storeFacade,
        UserFacadeInterface $userFacade,
        StateMachineFacadeInterface $stateMachineFacade,
        MailFacadeInterface $mailFacade,
        UtilTextServiceInterface $utilTextService,
        MerchantFacadeInterface $merchantFacade,
    ) {
        $this->localeFacade = $localeFacade;
        $this->merchantUserFacade = $merchantUserFacade;
        $this->storeFacade = $storeFacade;
        $this->userFacade = $userFacade;
        $this->stateMachineFacade = $stateMachineFacade;
        $this->mailFacade = $mailFacade;
        $this->utilTextService = $utilTextService;
        $this->merchantFacade = $merchantFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantResponseTransfer
     */
    public function merchantRegister(MerchantTransfer $merchantTransfer): MerchantResponseTransfer
    {
        /** @var StoreRelationTransfer $storeRelationTransfer */
        $storeRelationTransfer = $merchantTransfer->getStoreRelation();

        $idStores = $this->getIdStores($storeRelationTransfer);

        $merchantTransfer->getStoreRelation()?->setIdStores(array_unique($idStores));

        $merchantTransfer = $this->expandMerchantWithUrls($merchantTransfer);

        $merchantResponseTransfer = $this->merchantFacade->createMerchant($merchantTransfer);

        $userTransfer = new UserTransfer();
        $userTransfer->setFkLocale($this->localeFacade->getLocale('en_US')->getIdLocale());
        $userTransfer->setUsername($merchantTransfer->getEmail());
        $userTransfer->setFirstName($merchantTransfer->getMerchantProfile()?->getContactPersonFirstName());
        $userTransfer->setLastName($merchantTransfer->getMerchantProfile()?->getContactPersonLastName());
        $userTransfer->setPassword($merchantTransfer->getPassword());
        $userTransfer->setStatus(static::USER_STATUS_ACTIVE);

        $merchantUserTransfer = new MerchantUserTransfer();
        $merchantUserTransfer->setMerchant($merchantResponseTransfer->getMerchant());
        $merchantUserTransfer->setUser($userTransfer);
        $merchantUserTransfer->setIdMerchant($merchantResponseTransfer->getMerchant()?->getIdMerchant());

        $merchantUserResponseTransfer = $this->merchantUserFacade->createMerchantUser($merchantUserTransfer);
        $userTransfer = $merchantUserResponseTransfer->getMerchantUser()?->getUser();
        $userTransfer->setPassword($merchantTransfer->getPassword());
        $userTransfer->setStatus(static::USER_STATUS_ACTIVE);
        $this->userFacade->updateUser($userTransfer);

        /*$stateMachineProcessTransfer = (new StateMachineProcessTransfer())
            ->setProcessName(DemoStateMachineConfig::DEMO_OMS_DEFAULT_PROCESS_NAME)
            ->setStateMachineName(DemoStateMachineConfig::DEMO_STATE_MACHINE_STATE_MACHINE_NAME);

        $this->stateMachineFacade->triggerForNewStateMachineItem(
            $stateMachineProcessTransfer,
            $merchantTransfer->getIdMerchantOrFail(),
        );*/

        $this->sendRegistrationEmail($merchantTransfer);

        return $merchantResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\StoreRelationTransfer $storeRelationTransfer
     *
     * @return array
     */
    public function getIdStores(StoreRelationTransfer $storeRelationTransfer): array
    {
        $idStores = [];

        foreach ($storeRelationTransfer->getStores() as $storeTransfer) {
            $idStores[] = $this->storeFacade->getStoreByName($storeTransfer->getName())->getIdStore();
        }

        return $idStores;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return void
     */
    public function sendRegistrationEmail(MerchantTransfer $merchantTransfer): void
    {
        $mailTransfer = new MailTransfer();
        $mailTransfer->setType(MerchantRegistrationMailTypePlugin::MAIL_TYPE);
        $mailTransfer->setMerchant($merchantTransfer);
        $mailTransfer->setLocale($this->localeFacade->getCurrentLocale());

        $this->mailFacade->handleMail($mailTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantTransfer
     */
    public function expandMerchantWithUrls(MerchantTransfer $merchantTransfer): MerchantTransfer
    {
        $utilTextService = $this->utilTextService;
        $localeFacade = $this->localeFacade;

        $merchantTransfer->addUrl(
            (new UrlTransfer())
                ->setUrl('/en/merchant/' . $utilTextService->generateSlug($merchantTransfer->getName()))
                ->setFkLocale($localeFacade->getLocale('en_US')->getIdLocale()),
        );

        $merchantTransfer->addUrl(
            (new UrlTransfer())
                ->setUrl('/de/merchant/' . $utilTextService->generateSlug($merchantTransfer->getName()))
                ->setFkLocale($localeFacade->getLocale('de_DE')->getIdLocale()),
        );

        return $merchantTransfer;
    }
}
