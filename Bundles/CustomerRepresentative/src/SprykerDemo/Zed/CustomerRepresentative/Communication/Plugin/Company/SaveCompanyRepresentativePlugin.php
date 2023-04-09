<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\CustomerRepresentative\Communication\Plugin\Company;

use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CustomerRepresentativesTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerDemo\Zed\CustomerRepresentative\Communication\CustomerRepresentativeCommunicationFactory getFactory()
 */
class SaveCompanyRepresentativePlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerRepresentativesTransfer $customerRepresentativesTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRepresentativesTransfer
     */
    public function postSave(CustomerRepresentativesTransfer $customerRepresentativesTransfer): CustomerRepresentativesTransfer
    {
        $this->getFactory()
            ->getCustomerRepresentativeEntityManager()
            ->updateCompanyCustomerRepresentative($customerRepresentativesTransfer->getCompanyId(), $customerRepresentativesTransfer->getUserIds());

        return $customerRepresentativesTransfer;
    }
}
