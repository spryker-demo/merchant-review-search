<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Yves\MerchantRegistrationPage\Form\Validator\Constraints;

use SprykerDemo\Client\MerchantRegistration\MerchantRegistrationClientInterface;
use Symfony\Component\Validator\Constraint;

class CompanyNameUniqueConstraint extends Constraint
{
    /**
     * @var string
     */
    protected const MESSAGE = 'A merchant with same company name already exists';

    /**
     * @return string
     *
     * @var string
     */
    public const OPTION_MERCHANT_REGISTRATION_CLIENT = 'merchantRegistrationClient';

    /**
     * @var \SprykerDemo\Client\MerchantRegistration\MerchantRegistrationClientInterface
     */
    protected MerchantRegistrationClientInterface $merchantRegistrationClient;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return static::MESSAGE;
    }

    /**
     * @return \SprykerDemo\Client\MerchantRegistration\MerchantRegistrationClientInterface
     */
    public function getMerchantRegistrationClient(): MerchantRegistrationClientInterface
    {
        return $this->merchantRegistrationClient;
    }
}
