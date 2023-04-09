<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\CustomerRepresentative\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerDemo\Zed\CustomerRepresentative\Persistence\CustomerRepresentativeEntityManagerInterface;

/**
 * @method \SprykerDemo\Zed\CustomerRepresentative\CustomerRepresentativeConfig getConfig()
 * @method \SprykerDemo\Zed\CustomerRepresentative\Persistence\CustomerRepresentativeEntityManagerInterface getEntityManager()
 */
class CustomerRepresentativeCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \SprykerDemo\Zed\CustomerRepresentative\Persistence\CustomerRepresentativeEntityManagerInterface
     */
    public function getCustomerRepresentativeEntityManager(): CustomerRepresentativeEntityManagerInterface
    {
        return $this->getEntityManager();
    }
}
