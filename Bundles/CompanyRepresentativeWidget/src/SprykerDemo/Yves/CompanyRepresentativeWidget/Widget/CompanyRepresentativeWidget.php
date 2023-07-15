<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Yves\CompanyRepresentativeWidget\Widget;

use Spryker\Yves\Kernel\Dependency\Widget\WidgetInterface;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerDemo\Yves\CompanyRepresentativeWidget\CompanyRepresentativeWidgetFactory getFactory()
 */
class CompanyRepresentativeWidget extends AbstractWidget implements WidgetInterface
{
    public function __construct()
    {
        $this->addCompanyRepresentativesParameter();
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'CompanyRepresentativeWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@CompanyRepresentativeWidget/views/company-representative-widget/company-representative-widget.twig';
    }

    /**
     * @return void
     */
    protected function addCompanyRepresentativesParameter(): void
    {
        $customerTransfer = $this->getFactory()->getCustomerClient()->getCustomer();

        $this->addParameter('representatives', $customerTransfer->getCompanyUserTransfer()->getCompany()->getCompanyRepresentatives());
    }
}
