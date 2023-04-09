<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Form;

use Faker\Provider\Company;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CustomerRepresentativesTransfer;
use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentativeGui\Communication\CompanyRepresentativeGuiCommunicationFactory getFactory()
 */
class CompanyCustomerRepresentativesTypeChoiceFormType extends AbstractType
{
    /**
     * @var string
     */
    public const OPTION_VALUES_COMPANY_CUSTOMER_REPRESENTATIVES_TYPE_CHOICES = 'company_customer_representatives_type_value_options';

    /**
     * @var string
     */
    protected const FIELD_FK_COMPANY_USER = 'userIds';

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return $this
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->addCompanyCustomerRepresentativesField($builder, $options);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    protected function addCompanyCustomerRepresentativesField(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(CompanyTransfer::CUSTOMER_REPRESENTATIVES, ChoiceType::class, [
            'label' => 'Customer representatives',
            'placeholder' => 'Select one',
            'multiple' => true,
            'expanded' => true,
            'required' => true,
            'choices' => $options[static::OPTION_VALUES_COMPANY_CUSTOMER_REPRESENTATIVES_TYPE_CHOICES],
            'constraints' => [
                new NotBlank(),
            ],
        ]);

        $this->addCompanyCustomerRepresentativesTransformer($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return void
     */
    protected function addCompanyCustomerRepresentativesTransformer(FormBuilderInterface $builder): void
    {
        $builder->get('customerRepresentatives')
            ->addModelTransformer(
                new CallbackTransformer(
                    function ($customerRepresentatives) {
                        if (!$customerRepresentatives) {
                            return $customerRepresentatives;
                        }

                        $result = [];
                        if (isset($customerRepresentatives[static::FIELD_FK_COMPANY_USER])) {
                            foreach ($customerRepresentatives[static::COMPANY_UNIT_COST_CENTER_KEY] as $customerRepresentative) {
                                $result[] = $customerRepresentative[static::ID_COMPANY_UNIT_COST_CENTER_KEY];
                            }
                        }

                        return $result;
                    },
                    function ($data) {
                        $customerRepresentativesTransfer = new CustomerRepresentativesTransfer();

                        foreach ($data as $id) {
                            $customerRepresentativesTransfer->addUserId($id);
                        }

                        return $customerRepresentativesTransfer;
                    },
                ),
            );
    }
}
