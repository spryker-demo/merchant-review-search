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
    protected const SHEET_CATEGORY_TEMPLATE = 'category_template';

    /**
     * @var string
     */
    protected const SHEET_PRODUCT_PRICE = 'product_price';

    /**
     * @var string
     */
    protected const SHEET_PRODUCT_STOCK = 'product_stock';

    /**
     * @var string
     */
    protected const SHEET_PRODUCT_ABSTRACT = 'product_abstract';

    /**
     * @var string
     */
    protected const SHEET_PRODUCT_ABSTRACT_STORE = 'product_abstract_store';

    /**
     * @var string
     */
    protected const SHEET_PRODUCT_CONCRETE = 'product_concrete';

    /**
     * @var string
     */
    protected const SHEET_PRODUCT_ATTRIBUTE_KEY = 'product_attribute_key';

    /**
     * @var string
     */
    protected const SHEET_PRODUCT_MANAGEMENT_ATTRIBUTE = 'product_management_attribute';

    /**
     * @var string
     */
    protected const SHEET_PRODUCT_GROUP = 'product_group';

    /**
     * @var string
     */
    protected const SHEET_PRODUCT_IMAGE = 'product_image';

    /**
     * @var string
     */
    protected const SHEET_DIVIDED_PRODUCT_ABSTRACT = 'divided_product_abstract';

    /**
     * @var string
     */
    protected const SHEET_PRODUCT_APPROVAL_STATUS = 'product_approval_status';

    /**
     * @var string
     */
    protected const SHEET_DIVIDED_PRODUCT_ABSTRACT_MAIN_ATTRIBUTES = 'divided_product_abstract_main_attributes';

    /**
     * @var string
     */
    protected const SHEET_DIVIDED_PRODUCT_ABSTRACT_LOCALIZED_ATTRIBUTES = 'divided_product_abstract_localized_attributes';

    /**
     * @var string
     */
    protected const SHEET_DIVIDED_PRODUCT_ABSTRACT_URL = 'divided_product_abstract_url';

    /**
     * @var string
     */
    protected const SHEET_CATEGORY = 'category';

    /**
     * @var string
     */
    protected const SHEET_CATEGORY_STORE = 'category_store';

    /**
     * @var string
     */
    protected const SHEET_STOCK = 'stock';

    /**
     * @var string
     */
    protected const SHEET_MERCHANT_PRODUCT = 'merchant_product';

    /**
     * @var string
     */
    protected const SHEET_MERCHANT_PRODUCT_APPROVAL_STATUS_DEFAULT = 'merchant_product_approval_status_default';

    /**
     * @var string
     */
    protected const SHEET_MERCHANT_PRODUCT_OFFER = 'merchant_product_offer';

    /**
     * @var string
     */
    protected const SHEET_MERCHANT_PRODUCT_OFFER_STORE = 'merchant_product_offer_store';

    /**
     * @var string
     */
    protected const SHEET_PRODUCT_OFFER_STOCK = 'product_offer_stock';

    /**
     * @var string
     */
    protected const SHEET_PRICE_PRODUCT_OFFER = 'price_product_offer';

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
            static::SHEET_STOCK,
            static::SHEET_CATEGORY_TEMPLATE,
            static::SHEET_CATEGORY,
            static::SHEET_CATEGORY_STORE,
            static::SHEET_PRODUCT_ATTRIBUTE_KEY,
            static::SHEET_PRODUCT_MANAGEMENT_ATTRIBUTE,
            static::SHEET_PRODUCT_ABSTRACT,
            static::SHEET_PRODUCT_APPROVAL_STATUS,
            static::SHEET_PRODUCT_CONCRETE,
            static::SHEET_PRODUCT_IMAGE,
            static::SHEET_PRODUCT_PRICE,
            static::SHEET_PRODUCT_STOCK,
            static::SHEET_PRODUCT_GROUP,
            static::SHEET_PRODUCT_ABSTRACT_STORE,
            static::SHEET_DIVIDED_PRODUCT_ABSTRACT,
            static::SHEET_DIVIDED_PRODUCT_ABSTRACT_MAIN_ATTRIBUTES,
            static::SHEET_DIVIDED_PRODUCT_ABSTRACT_LOCALIZED_ATTRIBUTES,
            static::SHEET_DIVIDED_PRODUCT_ABSTRACT_URL,
            static::SHEET_MERCHANT_PRODUCT,
            static::SHEET_MERCHANT_PRODUCT_APPROVAL_STATUS_DEFAULT,
            static::SHEET_MERCHANT_PRODUCT_OFFER,
            static::SHEET_MERCHANT_PRODUCT_OFFER_STORE,
            static::SHEET_PRODUCT_OFFER_STOCK,
            static::SHEET_PRICE_PRODUCT_OFFER,
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
