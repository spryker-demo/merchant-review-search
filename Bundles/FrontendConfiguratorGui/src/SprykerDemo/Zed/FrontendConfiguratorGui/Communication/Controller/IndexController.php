<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerDemo\Zed\FrontendConfiguratorGui\Communication\FrontendConfiguratorGuiCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    public function editAction(Request $request)
    {
        $form = $this->getFactory()
            ->getFrontendConfigGuiForm()
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getFactory()->createFormHandler()->handle($form);
            $this->addSuccessMessage('Frontend config successfully updated');
            $form = $this->getFactory()->getFrontendConfigGuiForm();
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
