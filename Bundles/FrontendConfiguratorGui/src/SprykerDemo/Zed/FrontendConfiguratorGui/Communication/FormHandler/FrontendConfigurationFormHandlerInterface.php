<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfiguratorGui\Communication\FormHandler;

use Symfony\Component\Form\FormInterface;

interface FrontendConfigurationFormHandlerInterface
{
    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return void
     */
    public function handle(FormInterface $form): void;
}
