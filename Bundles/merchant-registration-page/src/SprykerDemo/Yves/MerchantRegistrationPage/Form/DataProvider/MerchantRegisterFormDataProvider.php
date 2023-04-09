<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Yves\MerchantRegistrationPage\Form\DataProvider;

use Generated\Shared\Transfer\MerchantRegistrationFormDataTransfer;
use SprykerDemo\Yves\MerchantRegistrationPage\Form\MerchantRegisterForm;
use Spryker\Shared\Kernel\Store;

class MerchantRegisterFormDataProvider
{
    /**
     * @var string
     */
    public const COUNTRY_GLOSSARY_PREFIX = 'countries.iso.';

    /**
     * @var \Spryker\Shared\Kernel\Store
     */
    protected $store;

    /**
     * @param \Spryker\Shared\Kernel\Store $store
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * @return \Generated\Shared\Transfer\MerchantRegistrationFormDataTransfer
     */
    public function getData(): MerchantRegistrationFormDataTransfer
    {
        return new MerchantRegistrationFormDataTransfer();
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            MerchantRegisterForm::OPTION_COUNTRY_CHOICES => $this->getAvailableCountries(),
        ];
    }

    /**
     * @return array
     */
    protected function getAvailableCountries(): array
    {
        $countries = [];

        foreach ($this->store->getCountries() as $iso2Code) {
            $countries[$iso2Code] = static::COUNTRY_GLOSSARY_PREFIX . $iso2Code;
        }

        return $countries;
    }
}
