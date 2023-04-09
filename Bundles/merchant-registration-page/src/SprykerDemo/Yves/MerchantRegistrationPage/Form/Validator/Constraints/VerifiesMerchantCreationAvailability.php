<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Yves\MerchantRegistrationPage\Form\Validator\Constraints;

use Generated\Shared\Transfer\MerchantTransfer;

trait VerifiesMerchantCreationAvailability
{
    /**
     * @param \Generated\Shared\Transfer\MerchantTransfer $merchantTransfer
     *
     * @return bool
     */
    protected function merchantHasAnyExistingData(MerchantTransfer $merchantTransfer): bool
    {
        return count(
            array_filter($merchantTransfer->toArray(), function ($value) {
                if (is_array($value)) {
                    return count($value) > 0;
                }

                return $value !== null;
            }),
        ) > 0;
    }
}
