<?php

namespace SprykerDemo\Yves\CustomerRepresentativeWidget\Widget;

use Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer;
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

    public static function getName(): string
    {
        // By convention the name of the widgets are equal with the name of the widget class to be able to find it easily from twig templates.
        // The widget names must be unique as they are registered globally.
        return 'CustomerRepresentativeWidget';
    }

    public static function getTemplate(): string
    {
        // The template of the widget to be rendered by default.
        return '@CustomerRepresentativeWidget/views/customer-representative-widget/customer-representative-widget.twig';
    }

    protected function addCustomerRepresentativesParameter()
    {
        $companyId = $this->getFactory()->getCustomerClient()->getCustomer()->getCompanyUserTransfer()->getCompany()->getIdCompany();
        $customerRepresentativesFilterTransfer = (new CustomerRepresentativesFilterTransfer())->setCompanyId($companyId);
        $customerRepresentatives = $this->getFactory()->getCustomerRepresentativeClient()->findCustomerRepresentatives($customerRepresentativesFilterTransfer);
        $this->addParameter('representatives',$customerRepresentatives);
    }
}
