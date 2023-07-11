<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiConfig;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

/**
 * @method \SprykerDemo\Zed\FrontendConfiguratorGui\Communication\FrontendConfiguratorGuiCommunicationFactory getFactory()
 * @method \SprykerDemo\Zed\FrontendConfiguratorGui\FrontendConfiguratorGuiConfig getConfig()
 */
class FrontendConfigurationForm extends AbstractType
{
    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_HEADER_COLOR = FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_HEADER_COLOR;

    public const FRONTEND_GUI_FIELD_HEADER_TEXT_COLOR = FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_HEADER_TEXT_COLOR;

    public const FRONTEND_GUI_FIELD_HEADER_TOPBAR_COLOR = FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_HEADER_TOPBAR_COLOR;

    public const FRONTEND_GUI_FIELD_HEADER_TOPBAR_TEXT_COLOR = FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_HEADER_TOPBAR_TEXT_COLOR;

    public const FRONTEND_GUI_FIELD_HEADER_NAVIGATION_BACKGROUND = FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_HEADER_NAVIGATION_BACKGROUND;

    public const FRONTEND_GUI_FIELD_HEADER_NAVIGATION_TEXT_COLOR = FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_HEADER_NAVIGATION_TEXT_COLOR;

    public const FRONTEND_GUI_FIELD_FOOTER_COLOR = FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_FOOTER_COLOR;

    public const FRONTEND_GUI_FIELD_FOOTER_TEXT_COLOR = FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_FOOTER_TEXT_COLOR;

    public const FRONTEND_GUI_FIELD_BUTTON_PRIMARY_COLOR = FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_BUTTON_PRIMARY_COLOR;

    public const FRONTEND_GUI_FIELD_LOGO_FILE = FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_LOGO_FILE;

    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_LOGO_FILE_DELETE = 'deleteLogo';

    public const FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE = FrontendConfiguratorGuiConfig::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE;

    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE_DELETE = 'deleteBackofficeLogo';

    /**
     * @var array<string>
     */
    public const LOGO_ALLOWED_MIME_TYPES = ['image/gif', 'image/png', 'image/jpeg', 'image/bmp', 'image/webp'];

    /**
     * @var string
     */
    public const LOGO_MAX_IMAGE_SIZE = '10M';

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
            $this
                ->addHeaderColorField($builder)
                ->addHeaderTextColorField($builder)
                ->addHeaderTopbarColorField($builder)
                ->addHeaderTopbarTextColorField($builder)
                ->addHeaderNavigationBackgroundField($builder)
                ->addHeaderNavigationTextColorField($builder)
                ->addFooterColorField($builder)
                ->addFooterTextColorField($builder)
                ->addButtonPrimaryColorField($builder)
                ->addLogoUploadField($builder, $options)
                ->addBackofficeLogoUploadField($builder, $options);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addHeaderColorField(FormBuilderInterface $builder)
    {
        $builder->add(static::FRONTEND_GUI_FIELD_HEADER_COLOR . 'switch', CheckboxType::class, [
            'label' => 'Active',
            'required' => false,
        ]);
        $builder->add(static::FRONTEND_GUI_FIELD_HEADER_COLOR, ColorType::class, [
            'label' => 'Header background color',
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addHeaderTextColorField(FormBuilderInterface $builder)
    {
        $builder->add(static::FRONTEND_GUI_FIELD_HEADER_TEXT_COLOR . 'switch', CheckboxType::class, [
            'label' => 'Active',
            'required' => false,
        ]);
        $builder->add(static::FRONTEND_GUI_FIELD_HEADER_TEXT_COLOR, ColorType::class, [
            'label' => 'Header text color',
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addHeaderTopbarColorField(FormBuilderInterface $builder)
    {
        $builder->add(static::FRONTEND_GUI_FIELD_HEADER_TOPBAR_COLOR . 'switch', CheckboxType::class, [
            'label' => 'Active',
            'required' => false,
        ]);
        $builder->add(static::FRONTEND_GUI_FIELD_HEADER_TOPBAR_COLOR, ColorType::class, [
            'label' => 'Header topbar background color',
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addHeaderTopbarTextColorField(FormBuilderInterface $builder)
    {
        $builder->add(static::FRONTEND_GUI_FIELD_HEADER_TOPBAR_TEXT_COLOR . 'switch', CheckboxType::class, [
            'label' => 'Active',
            'required' => false,
        ]);
        $builder->add(static::FRONTEND_GUI_FIELD_HEADER_TOPBAR_TEXT_COLOR, ColorType::class, [
            'label' => 'Header topbar text color',
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addHeaderNavigationBackgroundField(FormBuilderInterface $builder)
    {
        $builder->add(static::FRONTEND_GUI_FIELD_HEADER_NAVIGATION_BACKGROUND . 'switch', CheckboxType::class, [
            'label' => 'Active',
            'required' => false,
        ]);
        $builder->add(static::FRONTEND_GUI_FIELD_HEADER_NAVIGATION_BACKGROUND, ColorType::class, [
            'label' => 'Header navigation background color',
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addHeaderNavigationTextColorField(FormBuilderInterface $builder)
    {
        $builder->add(static::FRONTEND_GUI_FIELD_HEADER_NAVIGATION_TEXT_COLOR . 'switch', CheckboxType::class, [
            'label' => 'Active',
            'required' => false,
        ]);
        $builder->add(static::FRONTEND_GUI_FIELD_HEADER_NAVIGATION_TEXT_COLOR, ColorType::class, [
            'label' => 'Header navigation text color',
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addFooterColorField(FormBuilderInterface $builder)
    {
        $builder->add(static::FRONTEND_GUI_FIELD_FOOTER_COLOR . 'switch', CheckboxType::class, [
            'label' => 'Active',
            'required' => false,
        ]);
        $builder->add(static::FRONTEND_GUI_FIELD_FOOTER_COLOR, ColorType::class, [
            'label' => 'Footer background color',
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addFooterTextColorField(FormBuilderInterface $builder)
    {
        $builder->add(static::FRONTEND_GUI_FIELD_FOOTER_TEXT_COLOR . 'switch', CheckboxType::class, [
            'label' => 'Active',
            'required' => false,
        ]);
        $builder->add(static::FRONTEND_GUI_FIELD_FOOTER_TEXT_COLOR, ColorType::class, [
            'label' => 'Footer text color',
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addButtonPrimaryColorField(FormBuilderInterface $builder)
    {
        $builder->add(static::FRONTEND_GUI_FIELD_BUTTON_PRIMARY_COLOR . 'switch', CheckboxType::class, [
            'label' => 'Active',
            'required' => false,
        ]);
        $builder->add(static::FRONTEND_GUI_FIELD_BUTTON_PRIMARY_COLOR, ColorType::class, [
            'label' => 'Button primary background color',
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return $this
     */
    protected function addLogoUploadField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(static::FRONTEND_GUI_FIELD_LOGO_FILE, FileType::class, [
            'label' => false,
            'required' => false,
            'help' => $options['data'][static::FRONTEND_GUI_FIELD_LOGO_FILE] ?? '',
            'data_class' => null,
            'attr' => [
                'accept' => implode(', ', static::LOGO_ALLOWED_MIME_TYPES),
            ],
            'constraints' => [
                new File([
                    'mimeTypes' => static::LOGO_ALLOWED_MIME_TYPES,
                    'maxSize' => static::LOGO_MAX_IMAGE_SIZE,
                ]),
            ],
        ]);

        $builder->add(static::FRONTEND_GUI_FIELD_LOGO_FILE_DELETE, CheckboxType::class, [
            'label' => 'Delete Shop Logo',
            'required' => false,
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return $this
     */
    protected function addBackofficeLogoUploadField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(static::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE, FileType::class, [
            'label' => false,
            'required' => false,
            'help' => $options['data'][static::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE] ?? '',
            'data_class' => null,
            'attr' => [
                'accept' => implode(', ', static::LOGO_ALLOWED_MIME_TYPES),
            ],
            'constraints' => [
                new File([
                    'mimeTypes' => static::LOGO_ALLOWED_MIME_TYPES,
                    'maxSize' => static::LOGO_MAX_IMAGE_SIZE,
                ]),
            ],
        ]);

        $builder->add(static::FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE_DELETE, CheckboxType::class, [
            'label' => 'Delete Back Office Logo',
            'required' => false,
        ]);

        return $this;
    }
}
