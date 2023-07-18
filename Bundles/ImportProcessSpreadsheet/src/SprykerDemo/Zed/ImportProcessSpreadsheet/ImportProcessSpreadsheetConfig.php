<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ImportProcessSpreadsheet;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class ImportProcessSpreadsheetConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    protected const SOURCE_TYPE = 'spreadsheet';

    /**
     * @var int
     */
    protected const SPREADSHEET_READ_CHUNK_SIZE = 1000;

    /**
     * @var string
     */
    protected const IMPORT_TYPE_CATEGORY_TEMPLATE = 'category-template';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_PRODUCT_PRICE = 'product-price';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_PRODUCT_STOCK = 'product-stock';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_PRODUCT_ABSTRACT = 'product-abstract';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_PRODUCT_ABSTRACT_STORE = 'product-abstract-store';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_PRODUCT_CONCRETE = 'product-concrete';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_PRODUCT_ATTRIBUTE_KEY = 'product-attribute-key';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_PRODUCT_MANAGEMENT_ATTRIBUTE = 'product-management-attribute';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_PRODUCT_GROUP = 'product-group';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_PRODUCT_IMAGE = 'product-image';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_DIVIDED_PRODUCT_ABSTRACT = 'divided-product-abstract';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_PRODUCT_APPROVAL_STATUS = 'product-approval-status';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_DIVIDED_PRODUCT_ABSTRACT_MAIN_ATTRIBUTES = 'divided-product-abstract-main-attributes';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_DIVIDED_PRODUCT_ABSTRACT_LOCALIZED_ATTRIBUTES = 'divided-product-abstract-localized-attributes';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_DIVIDED_PRODUCT_ABSTRACT_URL = 'divided-product-abstract-url';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_CATEGORY = 'category';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_CATEGORY_STORE = 'category-store';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_STOCK = 'stock';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_MERCHANT_PRODUCT = 'merchant-product';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_MERCHANT_PRODUCT_APPROVAL_STATUS_DEFAULT = 'merchant-product-approval-status-default';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_MERCHANT_PRODUCT_OFFER = 'merchant-product-offer';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_MERCHANT_PRODUCT_OFFER_STORE = 'merchant-product-offer-store';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_PRODUCT_OFFER_STOCK = 'product-offer-stock';

    /**
     * @var string
     */
    protected const IMPORT_TYPE_PRICE_PRODUCT_OFFER = 'price-product-offer';

    /**
     * Specification:
     * - Gets applicable sorted import types.
     *
     * @api
     *
     * @return array<string>
     */
    public function getAllowedSheetNames(): array
    {
        return [
            static::IMPORT_TYPE_STOCK,
            static::IMPORT_TYPE_CATEGORY_TEMPLATE,
            static::IMPORT_TYPE_CATEGORY,
            static::IMPORT_TYPE_CATEGORY_STORE,
            static::IMPORT_TYPE_PRODUCT_ATTRIBUTE_KEY,
            static::IMPORT_TYPE_PRODUCT_MANAGEMENT_ATTRIBUTE,
            static::IMPORT_TYPE_PRODUCT_ABSTRACT,
            static::IMPORT_TYPE_PRODUCT_APPROVAL_STATUS,
            static::IMPORT_TYPE_PRODUCT_CONCRETE,
            static::IMPORT_TYPE_PRODUCT_IMAGE,
            static::IMPORT_TYPE_PRODUCT_PRICE,
            static::IMPORT_TYPE_PRODUCT_STOCK,
            static::IMPORT_TYPE_PRODUCT_GROUP,
            static::IMPORT_TYPE_PRODUCT_ABSTRACT_STORE,
            static::IMPORT_TYPE_DIVIDED_PRODUCT_ABSTRACT,
            static::IMPORT_TYPE_DIVIDED_PRODUCT_ABSTRACT_MAIN_ATTRIBUTES,
            static::IMPORT_TYPE_DIVIDED_PRODUCT_ABSTRACT_LOCALIZED_ATTRIBUTES,
            static::IMPORT_TYPE_DIVIDED_PRODUCT_ABSTRACT_URL,
            static::IMPORT_TYPE_MERCHANT_PRODUCT,
            static::IMPORT_TYPE_MERCHANT_PRODUCT_APPROVAL_STATUS_DEFAULT,
            static::IMPORT_TYPE_MERCHANT_PRODUCT_OFFER,
            static::IMPORT_TYPE_MERCHANT_PRODUCT_OFFER_STORE,
            static::IMPORT_TYPE_PRODUCT_OFFER_STOCK,
            static::IMPORT_TYPE_PRICE_PRODUCT_OFFER,
        ];
    }

    /**
     * @api
     *
     * @return string
     */
    public function getSourceType(): string
    {
        return static::SOURCE_TYPE;
    }

    /**
     * @api
     *
     * @return int
     */
    public function getSpreadsheetReadChunkSize(): int
    {
        return static::SPREADSHEET_READ_CHUNK_SIZE;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getSpreadsheetCsvSaveFilePath(): string
    {
        return APPLICATION_ROOT_DIR . '/data/tmp/import-process';
    }
}
