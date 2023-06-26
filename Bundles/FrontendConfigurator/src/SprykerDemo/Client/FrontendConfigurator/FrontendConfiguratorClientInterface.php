<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Client\FrontendConfigurator;

use Generated\Shared\Transfer\ConfigContainerTransfer;

interface FrontendConfiguratorClientInterface
{
    /**
     *  Specification:
     * - Get Frontend Configuration from zed
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\ConfigContainerTransfer
     */
    public function getFrontendConfigContainer(): ConfigContainerTransfer;
}
