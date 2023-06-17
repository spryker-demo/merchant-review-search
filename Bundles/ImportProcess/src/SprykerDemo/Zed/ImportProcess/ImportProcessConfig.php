<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Zed\ImportProcess;

use Pyz\Zed\DataImport\DataImportConfig;
use Spryker\Zed\CategoryDataImport\CategoryDataImportConfig;
use Spryker\Zed\Kernel\AbstractBundleConfig;
use Spryker\Zed\MerchantProductApprovalDataImport\MerchantProductApprovalDataImportConfig;
use Spryker\Zed\MerchantProductDataImport\MerchantProductDataImportConfig;
use Spryker\Zed\MerchantProductOfferDataImport\MerchantProductOfferDataImportConfig;
use Spryker\Zed\ProductApprovalDataImport\ProductApprovalDataImportConfig;
use Spryker\Zed\ProductOfferStockDataImport\ProductOfferStockDataImportConfig;
use Spryker\Zed\StockDataImport\StockDataImportConfig;

class ImportProcessConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getAvailableOrderedImportTypes(): array
    {
        return array_map(static function (string $item): string {
            return str_replace('-', '_', $item);
        }, [
            DataImportConfig::IMPORT_TYPE_PRODUCT_ABSTRACT,
            DataImportConfig::IMPORT_TYPE_PRODUCT_ABSTRACT_STORE,
            DataImportConfig::IMPORT_TYPE_PRODUCT_ATTRIBUTE_KEY,
            DataImportConfig::IMPORT_TYPE_PRODUCT_MANAGEMENT_ATTRIBUTE,
            DataImportConfig::IMPORT_TYPE_PRODUCT_CONCRETE,
            DataImportConfig::IMPORT_TYPE_PRODUCT_IMAGE,
            DataImportConfig::IMPORT_TYPE_PRODUCT_PRICE,
            DataImportConfig::IMPORT_TYPE_PRODUCT_STOCK,
            DataImportConfig::IMPORT_TYPE_PRODUCT_GROUP,
            DataImportConfig::IMPORT_TYPE_CATEGORY_TEMPLATE,
            CategoryDataImportConfig::IMPORT_TYPE_CATEGORY,
            CategoryDataImportConfig::IMPORT_TYPE_CATEGORY_STORE,
            StockDataImportConfig::IMPORT_TYPE_STOCK,
            DataImportConfig::IMPORT_TYPE_DIVIDED_PRODUCT_ABSTRACT,
            DataImportConfig::IMPORT_TYPE_DIVIDED_PRODUCT_ABSTRACT_MAIN_ATTRIBUTES,
            DataImportConfig::IMPORT_TYPE_DIVIDED_PRODUCT_ABSTRACT_LOCALIZED_ATTRIBUTES,
            DataImportConfig::IMPORT_TYPE_DIVIDED_PRODUCT_ABSTRACT_URL,
            MerchantProductDataImportConfig::IMPORT_TYPE_MERCHANT_PRODUCT,
            ProductApprovalDataImportConfig::IMPORT_TYPE_PRODUCT_APPROVAL_STATUS,
            MerchantProductApprovalDataImportConfig::IMPORT_TYPE_MERCHANT_PRODUCT_APPROVAL_STATUS_DEFAULT,
            MerchantProductOfferDataImportConfig::IMPORT_TYPE_MERCHANT_PRODUCT_OFFER,
            MerchantProductOfferDataImportConfig::IMPORT_TYPE_MERCHANT_PRODUCT_OFFER_STORE,
            ProductOfferStockDataImportConfig::IMPORT_TYPE_PRODUCT_OFFER_STOCK,
        ]);
    }
}
