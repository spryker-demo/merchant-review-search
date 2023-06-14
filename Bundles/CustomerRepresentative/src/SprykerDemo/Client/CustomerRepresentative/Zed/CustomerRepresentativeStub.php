<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Client\CustomerRepresentative\Zed;

use Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CustomerRepresentativesTransfer;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class CustomerRepresentativeStub implements CustomerRepresentativeStubInterface
{
    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedStub;

    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClientInterface $zedStub
     */
    public function __construct(ZedRequestClientInterface $zedStub)
    {
        $this->zedStub = $zedStub;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRepresentativesFilterTransfer $customerRepresentativesFilterTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRepresentativesTransfer
     */
    public function findCustomerRepresentatives(CustomerRepresentativesFilterTransfer $customerRepresentativesFilterTransfer): CustomerRepresentativesTransfer
    {
        /** @var \Generated\Shared\Transfer\CustomerRepresentativesTransfer $response */
        $response = $this->zedStub->call('/customer-representative/gateway/find-customer-representatives', $customerRepresentativesFilterTransfer);

        return $response;
    }
}
