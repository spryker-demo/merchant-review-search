<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
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
