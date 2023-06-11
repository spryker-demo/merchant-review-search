<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantRegistration;

use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerDemo\Shared\MerchantRegistration\MerchantRegistrationConstants;

class MerchantRegistrationConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @return string
     */
    public function getZedHost(): string
    {
        return $this->get(ApplicationConstants::BASE_URL_ZED);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getMerchantRegistrationRecipientEmail(): string
    {
        return $this->getConfig()->get(MerchantRegistrationConstants::MERCHANT_REGISTRATION_RECIPIENT_MAIL);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getMerchantRegistrationRecipientName(): string
    {
        return $this->getConfig()->get(MerchantRegistrationConstants::MERCHANT_REGISTRATION_RECIPIENT_NAME);
    }
}
