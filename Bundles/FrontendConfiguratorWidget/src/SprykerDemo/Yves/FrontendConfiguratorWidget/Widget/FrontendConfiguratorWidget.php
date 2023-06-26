<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
        $this->addParameter('data', $this->getConfigContainer());
    }

    /**
     * @return array
     */
    protected function getConfigContainer(): array
    {
        /** @var \Generated\Shared\Transfer\ConfigContainerTransfer $configContainerTransfer */
        $configContainerTransfer = $this->getFactory()->getFrontendConfigClient()->getFrontendConfigContainer();

        return $configContainerTransfer->getData();
    }
}
