<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\CompanyRepresentative\Persistence;

use Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer;
use Generated\Shared\Transfer\CompanyRepresentativesTransfer;
use Generated\Shared\Transfer\UserTransfer;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerDemo\Zed\CompanyRepresentative\Persistence\CompanyRepresentativePersistenceFactory getFactory()
 */
class CompanyRepresentativeRepository extends AbstractRepository implements CompanyRepresentativeRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRepresentativesFilterTransfer $companyRepresentativesFilterTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRepresentativesTransfer
     */
    public function findCompanyRepresentatives(CompanyRepresentativesFilterTransfer $companyRepresentativesFilterTransfer): CompanyRepresentativesTransfer
    {
        $CompanyRepresentativesCollection = $this->getFactory()
            ->createCompanyRepresentativeQuery()
            ->filterByFkCompany($companyRepresentativesFilterTransfer->getCompanyId())
            ->useUserQuery()
            ->endUse()
            ->find();

        return $this->mapCompanyRepresentativesCollectionToTransfer($CompanyRepresentativesCollection, $companyRepresentativesFilterTransfer->getCompanyId());
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $CompanyRepresentativesCollection
     * @param int $companyId
     *
     * @return \Generated\Shared\Transfer\CompanyRepresentativesTransfer
     */
    protected function mapCompanyRepresentativesCollectionToTransfer(
        ObjectCollection $CompanyRepresentativesCollection,
        int $companyId
    ): CompanyRepresentativesTransfer {
        $companyRepresentativesTransfer = new CompanyRepresentativesTransfer();

        foreach ($CompanyRepresentativesCollection as $CompanyRepresentative) {
            $companyRepresentativesTransfer->addUserId($CompanyRepresentative->getUser()->getIdUser());
            $userTransfer = (new UserTransfer())->fromArray($CompanyRepresentative->getUser()->toArray(), true);
            $companyRepresentativesTransfer->addUser($userTransfer);
        }

        $companyRepresentativesTransfer->setCompanyId($companyId);

        return $companyRepresentativesTransfer;
    }
}
