<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Yves\CustomerSubscriptionPage\Reader;

use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\OrderListFormatTransfer;
use Generated\Shared\Transfer\OrderListTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Client\Sales\SalesClientInterface;
use Symfony\Component\HttpFoundation\Request;

class OrderReader
{
    /**
     * @var string
     */
    protected const PARAM_PAGE = 'page';

    /**
     * @var string
     */
    protected const PARAM_PER_PAGE = 'perPage';

    /**
     * @var int
     */
    protected const DEFAULT_PAGE = 1;

    /**
     * @var int
     */
    protected const DEFAULT_ITEMS_PAGE = 10;

    private CustomerClientInterface $customerClient;

    private SalesClientInterface $salesClient;

    /**
     * @param \Spryker\Client\Customer\CustomerClientInterface $customerClient
     * @param \Spryker\Client\Sales\SalesClientInterface $salesClient
     */
    public function __construct(
        CustomerClientInterface $customerClient,
        SalesClientInterface $salesClient
    ) {
        $this->customerClient = $customerClient;
        $this->salesClient = $salesClient;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\OrderListTransfer $orderListTransfer
     *
     * @return \Generated\Shared\Transfer\OrderListTransfer
     */
    public function getOrderList(Request $request, OrderListTransfer $orderListTransfer): OrderListTransfer
    {
        $orderListTransfer = $this->expandOrderListTransfer($request, $orderListTransfer);

        return $this->salesClient->getPaginatedCustomerOrdersOverview($orderListTransfer);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\OrderListTransfer $orderListTransfer
     *
     * @return \Generated\Shared\Transfer\OrderListTransfer
     */
    protected function expandOrderListTransfer(Request $request, OrderListTransfer $orderListTransfer): OrderListTransfer
    {
        $customerTransfer = $this->customerClient->getCustomer();

        $orderListTransfer
            ->setIdCustomer($customerTransfer->getIdCustomer())
            ->setCustomerReference($customerTransfer->getCustomerReference());

        $orderListTransfer->setPagination(
            $this->createPaginationTransfer($request),
        );

        if (!$orderListTransfer->getFilter()) {
            $orderListTransfer->setFilter($this->createFilterTransfer());
        }

        if (!$orderListTransfer->getFormat()) {
            $orderListTransfer->setFormat(new OrderListFormatTransfer());
        }

        return $orderListTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\FilterTransfer
     */
    protected function createFilterTransfer(): FilterTransfer
    {
        $filterTransfer = new FilterTransfer();
        $filterTransfer->setOrderBy('created_at');
        $filterTransfer->setOrderDirection('DESC');

        return $filterTransfer;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\PaginationTransfer
     */
    protected function createPaginationTransfer(Request $request): PaginationTransfer
    {
        $paginationTransfer = new PaginationTransfer();

        $paginationTransfer->setPage(
            $request->query->getInt(static::PARAM_PAGE, static::DEFAULT_PAGE),
        );
        $paginationTransfer->setMaxPerPage(
            $request->query->getInt(static::PARAM_PER_PAGE, static::DEFAULT_ITEMS_PAGE),
        );

        return $paginationTransfer;
    }
}
