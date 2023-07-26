<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * @method \SprykerDemo\Zed\ImportProcessGoogleSheetsGui\Communication\ImportProcessGoogleSheetsGuiCommunicationFactory getFactory()
 */
class SelectSheetForm extends AbstractType
{
    /**
     * @var string
     */
    public const FIELD_SHEET_URL = 'sheetUrl';

    /**
     * @var string
     */
    protected const BLOCK_PREFIX = 'selectSheetForm';

    /**
     * @var string
     */
    protected const LABEL_SPREADSHEET_URL = 'Spreadsheet URL';

    /**
     * @var string
     */
    protected const REGEX_SPREADSHEET_URL = '/^https:\/\/docs.google.com\/spreadsheets\/d\/[a-zA-Z0-9_-]+\/edit(.*)$/';

    /**
     * @var string
     */
    protected const VALIDATION_MESSAGE_SPREADSHEET_URL = 'Please enter a valid Google Spreadsheet URL';

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'label' => false,
        ]);
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return static::BLOCK_PREFIX;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addSheetUrlField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addSheetUrlField(FormBuilderInterface $builder)
    {
        $builder->add(static::FIELD_SHEET_URL, TextType::class, [
            'label' => static::LABEL_SPREADSHEET_URL,
            'required' => true,
            'attr' => [
                'placeholder' => '',
            ],
            'constraints' => [
                new Regex([
                    'pattern' => static::REGEX_SPREADSHEET_URL,
                    'message' => static::VALIDATION_MESSAGE_SPREADSHEET_URL,
                ]),
            ],
        ]);

        return $this;
    }
}
