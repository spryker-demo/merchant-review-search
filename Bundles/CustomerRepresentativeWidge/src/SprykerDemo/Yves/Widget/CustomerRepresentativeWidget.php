<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Yves\CustomerRepresentative\Widget;

use Spryker\Yves\Kernel\Dependency\Widget\WidgetInterface;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

class CustomerRepresentativeWidget extends AbstractWidget implements WidgetInterface
{
    public function getParameters(): array
    {
        return [];
    }

    public static function getName(): string
    {
        return 'CustomerRepresentativeWidget';
    }

    public static function getTemplate(): string
    {
        return '@CustomerRepresentative/views/customer-representative-widget/customer-representative-widget.twig';
    }
}
