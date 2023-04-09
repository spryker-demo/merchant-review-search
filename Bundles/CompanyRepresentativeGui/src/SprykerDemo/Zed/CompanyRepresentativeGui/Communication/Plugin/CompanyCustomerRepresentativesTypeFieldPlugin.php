<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Plugin;

use Spryker\Zed\CompanyGuiExtension\Dependency\Plugin\CompanyFormExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentativeGui\Communication\CompanyRepresentativeGuiCommunicationFactory getFactory()
 * @method \SprykerDemo\Zed\CompanyRepresentativeGui\CompanyRepresentativeGuiConfig getConfig()
 */
class CompanyCustomerRepresentativesTypeFieldPlugin extends AbstractPlugin implements CompanyFormExpanderPluginInterface
{
    /**
     * @var string
     */
    public const FIELD_REPRESENTATIVE = 'representative';

    /**
     * @var string
     */
    protected const FIELD_FK_COMPANY_USER = 'userIds';

    public function buildForm(FormBuilderInterface $builder): void
    {
        $formType = $this->getFactory()
            ->createCompanyCustomerRepresentativesChoiceFormType();

        $dataProvider = $this->getFactory()
            ->createCompanyCustomerRepresentativeTypeChoiceFormDataProvider();

        $formType->buildForm(
            $builder,
            $dataProvider->getOptions(),
        );
    }
}
