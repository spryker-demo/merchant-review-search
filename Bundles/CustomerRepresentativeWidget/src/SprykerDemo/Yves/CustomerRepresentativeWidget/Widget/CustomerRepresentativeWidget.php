<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Yves\CustomerRepresentativeWidget\Widget;

use Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer;
use Spryker\Yves\Kernel\Dependency\Widget\WidgetInterface;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerDemo\Yves\CustomerRepresentativeWidget\CustomerRepresentativeWidgetFactory getFactory()
 */
class CustomerRepresentativeWidget extends AbstractWidget implements WidgetInterface
{
    public function __construct()
    {
        $this->addCustomerRepresentativesParameter();
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'CustomerRepresentativeWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@CustomerRepresentativeWidget/views/customer-representative-widget/customer-representative-widget.twig';
    }

    /**
     * @return void
     */
    protected function addCustomerRepresentativesParameter(): void
    {
        $companyId = $this->getFactory()->getCustomerClient()->getCustomer()->getCompanyUserTransfer()->getCompany()->getIdCompany();
        $customerRepresentativesFilterTransfer = (new CompanyRepresentativesFilterTransfer())->setCompanyId($companyId);
        $customerRepresentatives = $this->getFactory()->getCompanyRepresentativeClient()->findCustomerRepresentatives($customerRepresentativesFilterTransfer);
        $this->addParameter('representatives', $customerRepresentatives);
    }
}
