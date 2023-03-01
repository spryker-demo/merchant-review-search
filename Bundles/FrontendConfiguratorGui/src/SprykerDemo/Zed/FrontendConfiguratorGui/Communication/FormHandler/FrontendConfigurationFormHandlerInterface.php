<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
