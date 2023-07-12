<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Service\GoogleSpreadsheets;

use Google_Service_Sheets;
use Spryker\Service\Kernel\AbstractBundleConfig;
use SprykerDemo\Shared\GoogleSpreadsheets\GoogleSpreadsheetsConstants;

class GoogleSpreadsheetsConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const CREDENTIAL_FIELD_TYPE = 'type';

    /**
     * @var string
     */
    public const CREDENTIAL_FIELD_PROJECT_ID = 'project_id';

    /**
     * @var string
     */
    public const CREDENTIAL_FIELD_PRIVATE_KEY_ID = 'private_key_id';

    /**
     * @var string
     */
    public const CREDENTIAL_FIELD_PRIVATE_KEY = 'private_key';

    /**
     * @var string
     */
    public const CREDENTIAL_FIELD_CLIENT_EMAIL = 'client_email';

    /**
     * @var string
     */
    public const CREDENTIAL_FIELD_CLIENT_ID = 'client_id';

    /**
     * @var string
     */
    public const CREDENTIAL_FIELD_AUTH_URI = 'auth_uri';

    /**
     * @var string
     */
    public const CREDENTIAL_FIELD_TOKEN_URI = 'token_uri';

    /**
     * @var string
     */
    public const CREDENTIAL_FIELD_AUTH_PROVIDER_X_509_CERT_URL = 'auth_provider_x509_cert_url';

    /**
     * @var string
     */
    public const CREDENTIAL_FIELD_CLIENT_X_509_CERT_URL = 'client_x509_cert_url';

    /**
     * @var string
     */
    protected const APPLICATION_NAME = 'Google Spreadsheets';

    /**
     * @var array<string>
     */
    protected const SCOPES = [
        Google_Service_Sheets::SPREADSHEETS,
    ];

    /**
     * @var string
     */
    protected const ACCESS_TYPE = 'offline';

    /**
     * @api
     *
     * @return string
     */
    public function getApplicationName(): string
    {
        return static::APPLICATION_NAME;
    }

    /**
     * @api
     *
     * @return array<string>
     */
    public function getScopes(): array
    {
        return static::SCOPES;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getAccessType(): string
    {
        return static::ACCESS_TYPE;
    }

    /**
     * @api
     *
     * @return array<string>
     */
    public function getSpreadsheetsCredentials(): array
    {
        return $this->get(GoogleSpreadsheetsConstants::SPREADSHEET_CREDENTIALS, []);
    }
}
