<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfiguratorGui;

use Spryker\Shared\Config\Config;
use Spryker\Shared\FileSystem\FileSystemConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class FrontendConfiguratorGuiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    protected const FILE_SYSTEM_NAME = 'logo';

    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_HEADER_COLOR = 'headerColor';

    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_HEADER_TEXT_COLOR = 'headerTextColor';

    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_HEADER_TOPBAR_COLOR = 'headerTopbarColor';

    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_HEADER_TOPBAR_TEXT_COLOR = 'headerTopbarTextColor';

    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_HEADER_NAVIGATION_BACKGROUND = 'headerNavigationBackground';

    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_HEADER_NAVIGATION_TEXT_COLOR = 'headerNavigationTextColor';

    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_FOOTER_COLOR = 'footerColor';

    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_FOOTER_TEXT_COLOR = 'footerTextColor';

    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_BUTTON_PRIMARY_COLOR = 'buttonPrimaryColor';

    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_LOGO_FILE = 'logoUrl';

    /**
     * @var string
     */
    public const FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE = 'backofficeLogoUrl';

    /**
     * @api
     *
     * @return array<string>
     */
    public function getColorsMarkersNames(): array
    {
        return [
            static::FRONTEND_GUI_FIELD_HEADER_COLOR,
            static::FRONTEND_GUI_FIELD_HEADER_TEXT_COLOR,
            static::FRONTEND_GUI_FIELD_HEADER_TOPBAR_COLOR,
            static::FRONTEND_GUI_FIELD_HEADER_TOPBAR_TEXT_COLOR,
            static::FRONTEND_GUI_FIELD_HEADER_NAVIGATION_BACKGROUND,
            static::FRONTEND_GUI_FIELD_HEADER_NAVIGATION_TEXT_COLOR,
            static::FRONTEND_GUI_FIELD_FOOTER_COLOR,
            static::FRONTEND_GUI_FIELD_FOOTER_TEXT_COLOR,
            static::FRONTEND_GUI_FIELD_BUTTON_PRIMARY_COLOR,
        ];
    }

    /**
     * @api
     *
     * @return string
     */
    public function getFileSystemName(): string
    {
        return static::FILE_SYSTEM_NAME;
    }

    /**
     * @api
     *
     * @param string $fileSystemName
     *
     * @return mixed
     */
    public function getFileSystemConfigByName(string $fileSystemName)
    {
        return Config::get(FileSystemConstants::FILESYSTEM_SERVICE)[$fileSystemName];
    }

    /**
     * @api
     *
     * @return array<string>
     */
    public function getFileSystemWriterConfig(): array
    {
        return [
            'ACL' => 'public-read',
        ];
    }
}
