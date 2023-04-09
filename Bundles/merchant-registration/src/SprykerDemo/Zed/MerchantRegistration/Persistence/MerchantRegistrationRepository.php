<?php

/**
* Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
* Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
*/

namespace SprykerDemo\Zed\MerchantRegistration\Persistence;

use Generated\Shared\Transfer\MerchantCriteriaTransfer;
use Orm\Zed\Merchant\Persistence\SpyMerchantQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerDemo\Zed\MerchantRegistration\Persistence\MerchantRegistrationPersistenceFactory getFactory()
 */
class MerchantRegistrationRepository extends AbstractRepository implements MerchantRegistrationRepositoryInterface
{
    /**
     * @param \Orm\Zed\Merchant\Persistence\SpyMerchantQuery $merchantQuery
     * @param \Generated\Shared\Transfer\MerchantCriteriaTransfer $merchantCriteriaTransfer
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery
     */
    protected function applyFilters(SpyMerchantQuery $merchantQuery, MerchantCriteriaTransfer $merchantCriteriaTransfer): SpyMerchantQuery
    {
        $merchantQuery = parent::applyFilters($merchantQuery, $merchantCriteriaTransfer);

        if ($merchantCriteriaTransfer->getName() !== null) {
            $merchantQuery->filterByName_Like('%' . $merchantCriteriaTransfer->getName() . '%');
        }

        return $merchantQuery;
    }
}
