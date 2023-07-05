<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Yves\FrontendConfiguratorWidget\Widget;

use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerDemo\Yves\FrontendConfiguratorWidget\FrontendConfiguratorWidgetFactory getFactory()
 */
class FrontendConfiguratorWidget extends AbstractWidget
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'FrontendConfiguratorWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@FrontendConfiguratorWidget/views/frontend-config-gui-widget/frontend-config-gui-widget.twig';
    }

    public function __construct()
    {
        $this->addParameter('data', $this->getFrontendConfiguration());
    }

    /**
     * @return array<string, mixed>
     */
    protected function getFrontendConfiguration(): array
    {
        return $this->getFactory()
            ->getFrontendConfiguratorStorageClient()
            ->getFrontendConfiguration()
            ->getData();
    }
}
