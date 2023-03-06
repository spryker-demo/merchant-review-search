<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\FrontendConfiguratorGui;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class FrontendConfiguratorGuiConfig extends AbstractBundleConfig
{
    public const FILE_SYSTEM_NAME = 'logo';
    public const FRONTEND_GUI_FIELD_HEADER_COLOR = 'headerColor';
    public const FRONTEND_GUI_FIELD_HEADER_TEXT_COLOR = 'headerTextColor';
    public const FRONTEND_GUI_FIELD_HEADER_TOPBAR_COLOR = 'headerTopbarColor';
    public const FRONTEND_GUI_FIELD_HEADER_TOPBAR_TEXT_COLOR = 'headerTopbarTextColor';
    public const FRONTEND_GUI_FIELD_HEADER_NAVIGATION_BACKGROUND = 'headerNavigationBackground';
    public const FRONTEND_GUI_FIELD_HEADER_NAVIGATION_TEXT_COLOR = 'headerNavigationTextColor';
    public const FRONTEND_GUI_FIELD_FOOTER_COLOR = 'footerColor';
    public const FRONTEND_GUI_FIELD_FOOTER_TEXT_COLOR = 'footerTextColor';
    public const FRONTEND_GUI_FIELD_BUTTON_PRIMARY_COLOR = 'buttonPrimaryColor';
    public const FRONTEND_GUI_FIELD_LOGO_FILE = 'logoUrl';
    public const FRONTEND_GUI_FIELD_BACKOFFICE_LOGO_FILE = 'backofficeLogoUrl';

    /**
     * @return string[]
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
     * @return string
     */
    public function getFileSystemName(): string
    {
        return static::FILE_SYSTEM_NAME;
    }
}
