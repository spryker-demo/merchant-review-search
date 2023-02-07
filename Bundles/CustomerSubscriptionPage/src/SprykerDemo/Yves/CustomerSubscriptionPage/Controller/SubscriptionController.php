<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Yves\CustomerSubscriptionPage\Controller;

use Generated\Shared\Transfer\OrderListTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use SprykerDemo\Yves\CustomerSubscriptionPage\Plugin\Router\CustomerSubscriptionPageRouteProviderPlugin;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerDemo\Yves\CustomerSubscriptionPage\CustomerSubscriptionPageFactory getFactory()
 */
class SubscriptionController extends AbstractController
{
    /**
     * @var string
     */
    protected const CUSTOMER_CANCEL_SUBSCRIPTION_SUCCESS_MESSAGE = 'customer.cancel_subscription.success_message';
    /**
     * @var string
     */
    protected const CUSTOMER_CANCEL_SUBSCRIPTION_ERROR_MESSAGE = 'customer.cancel_subscription.error_message';
    /**
     * @var string
     */
    protected const CUSTOMER_CANCEL_SUBSCRIPTION_WARNING_MESSAGE = 'customer.cancel_subscription.warning_message';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Spryker\Yves\Kernel\View\View|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request)
    {
        $viewData = $this->executeIndexAction($request);

        return $this->view(
            $viewData,
            [],
            '@CustomerSubscriptionPage/views/subscription/subscription.twig',
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    protected function executeIndexAction(Request $request): array
    {
        $orderListTransfer = new OrderListTransfer();
        $customerPageFactory = $this->getFactory();

        $orderListTransfer = $customerPageFactory->createOrderReader()
            ->getOrderList($request, $orderListTransfer);
        $orderListTransfer = $this->getFactory()->getSalesClient()
            ->getPaginatedOrder($orderListTransfer);

        return [
            'pagination' => $orderListTransfer->getPagination(),
            'orderList' => $orderListTransfer,
            'isOrderSearchEnabled' => false,
            'isOrderSearchOrderItemsVisible' => true,
            'customerCancelSubscriptionForm' => $this->getFactory()->createCustomerFormFactory()->getCustomerCancelSubscriptionForm()->createView(),
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Spryker\Yves\Kernel\View\View|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function cancelAction(Request $request)
    {
        $customerTransfer = $this->getFactory()->getCustomerClient()->getCustomer();
        $idSalesOrder = $request->query->get('sales_order_id');

        $orderTransfer = new OrderTransfer();
        $orderTransfer->setIdSalesOrder($idSalesOrder)
            ->setFkCustomer($customerTransfer->getIdCustomer())
            ->setCustomer($customerTransfer);

        $orderTransfer = $this->getFactory()->getSalesClient()->getOrderDetails($orderTransfer);
        $itemTransfer = $this->getItemTransfer($orderTransfer, $request->query->get('sales_order_item_id'));

        if ($orderTransfer->getIdSalesOrder() !== null && $itemTransfer && $itemTransfer->getState()->getName() == 'subscription active') {
            $successMessage = $this->getFactory()->getGlossaryClient()->translate(
                static::CUSTOMER_CANCEL_SUBSCRIPTION_SUCCESS_MESSAGE,
                $this->getLocale(),
                ['%product%' => $itemTransfer->getName()]
            );

            $this->getFactory()->getCustomerSubscriptionClient()->cancelOrderItemSubscription($itemTransfer);

            $this->addSuccessMessage($successMessage);
        } elseif ($itemTransfer->getState()->getName() == 'subscription cancelled' || $itemTransfer->getState()->getName() == 'closed') {
            $this->addErrorMessage(static::CUSTOMER_CANCEL_SUBSCRIPTION_WARNING_MESSAGE);
        } else {
            $this->addErrorMessage(static::CUSTOMER_CANCEL_SUBSCRIPTION_ERROR_MESSAGE);
        }

        return $this->redirectResponseInternal(CustomerSubscriptionPageRouteProviderPlugin::ROUTE_SUBSCRIPTION);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param int $orderItemId
     *
     * @return \Generated\Shared\Transfer\ItemTransfer|mixed
     */
    protected function getItemTransfer(OrderTransfer $orderTransfer, int $orderItemId)
    {
        foreach ($orderTransfer->getItems() as $item) {
            if ($item->getIdSalesOrderItem() == $orderItemId) {
                return $item;
            }
        }

        return null;
    }
}
