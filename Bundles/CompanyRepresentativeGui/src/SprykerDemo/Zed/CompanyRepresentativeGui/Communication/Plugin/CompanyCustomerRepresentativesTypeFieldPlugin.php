<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Plugin;

use Spryker\Zed\CompanyGuiExtension\Dependency\Plugin\CompanyFormExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentativeGui\Communication\CompanyRepresentativeGuiCommunicationFactory getFactory()
 */
class CompanyCustomerRepresentativesTypeFieldPlugin extends AbstractPlugin implements CompanyFormExpanderPluginInterface
{
    /**
     * @var string
     */
    public const FIELD_REPRESENTATIVE = 'representative';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder): void
    {
        $formType = $this->getFactory()
            ->createCompanyCustomerRepresentativesChoiceFormType();

        $dataProvider = $this->getFactory()
            ->createCompanyCustomerRepresentativeTypeChoiceFormDataProvider();

        $customerRepresentativesTransfer = $builder->getData();
        $result = $dataProvider->getData($customerRepresentativesTransfer->getIdCompany());
        $customerRepresentativesTransfer->setCustomerRepresentatives($result);

        $formType->buildForm(
            $builder,
            $dataProvider->getOptions(),
        );
    }
}
