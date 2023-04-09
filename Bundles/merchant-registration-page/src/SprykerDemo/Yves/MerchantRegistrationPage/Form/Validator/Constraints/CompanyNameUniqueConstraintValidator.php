<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Yves\MerchantRegistrationPage\Form\Validator\Constraints;

use Generated\Shared\Transfer\MerchantCriteriaTransfer;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @method \SprykerDemo\Yves\MerchantRegistrationPage\MerchantRegistrationPageFactory getFactory()
 */
class CompanyNameUniqueConstraintValidator extends ConstraintValidator
{
    use VerifiesMerchantCreationAvailability;

    /**
     * @param mixed|string $value
     * @param \Symfony\Component\Validator\Constraint $constraint
     *
     * @throws \Symfony\Component\Form\Exception\UnexpectedTypeException
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$value) {
            return;
        }

        if (!$constraint instanceof CompanyNameUniqueConstraint) {
            throw new UnexpectedTypeException($constraint, CompanyNameUniqueConstraint::class);
        }

        $merchantTransfer = $constraint->getMerchantRegistrationClient()
            ->merchantExists(
                (new MerchantCriteriaTransfer())->setName($value),
            );

        if ($this->merchantHasAnyExistingData($merchantTransfer)) {
            $this->context->buildViolation($constraint->getMessage())->addViolation();
        }
    }
}
