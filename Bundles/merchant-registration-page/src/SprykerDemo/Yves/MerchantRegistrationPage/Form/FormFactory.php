<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Yves\MerchantRegistrationPage\Form;

use Generated\Shared\Transfer\MerchantRegistrationFormDataTransfer;
use SprykerDemo\Yves\MerchantRegistrationPage\Form\DataProvider\MerchantRegisterFormDataProvider;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Kernel\AbstractFactory;
use SprykerDemo\Yves\MerchantRegistrationPage\MerchantRegistrationPageDependencyProvider;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class FormFactory extends AbstractFactory
{
    /**
     * @return \Symfony\Component\Form\FormFactory
     */
    public function getFormFactory(): FormFactoryInterface
    {
        return $this->getProvidedDependency(ApplicationConstants::FORM_FACTORY);
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantRegistrationFormDataTransfer $data
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getMerchantRegisterForm(MerchantRegistrationFormDataTransfer $data, array $formOptions): FormInterface
    {
        return $this->getFormFactory()->create(MerchantRegisterForm::class, $data, $formOptions);
    }

    /**
     * @return \SprykerDemo\Yves\MerchantRegistrationPage\Form\DataProvider\MerchantRegisterFormDataProvider
     */
    public function createMerchantRegisterFormDataProvider(): MerchantRegisterFormDataProvider
    {
        return new MerchantRegisterFormDataProvider($this->getStore());
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    public function getStore(): Store
    {
        return $this->getProvidedDependency(MerchantRegistrationPageDependencyProvider::STORE);
    }
}
