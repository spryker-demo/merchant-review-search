<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerDemo\Service\GoogleSpreadsheets;

use SprykerDemo\Shared\GoogleSpreadsheets\GoogleSpreadsheetsConstants;
use Spryker\Service\Kernel\AbstractBundleConfig;

class GoogleSpreadsheetsConfig extends AbstractBundleConfig
{
    public const CREDENTIAL_FIELD_TYPE = 'type';
    public const CREDENTIAL_FIELD_PROJECT_ID = 'project_id';
    public const CREDENTIAL_FIELD_PRIVATE_KEY_ID = 'private_key_id';
    public const CREDENTIAL_FIELD_PRIVATE_KEY = 'private_key';
    public const CREDENTIAL_FIELD_CLIENT_EMAIL = 'client_email';
    public const CREDENTIAL_FIELD_CLIENT_ID = 'client_id';
    public const CREDENTIAL_FIELD_AUTH_URI = 'auth_uri';
    public const CREDENTIAL_FIELD_TOKEN_URI = 'token_uri';
    public const CREDENTIAL_FIELD_AUTH_PROVIDER_X_509_CERT_URL = 'auth_provider_x509_cert_url';
    public const CREDENTIAL_FIELD_CLIENT_X_509_CERT_URL = 'client_x509_cert_url';

    /**
     * @api
     *
     * @return array
     */
    public function getSpreadsheetsCredentials(): array
    {
        return $this->get(GoogleSpreadsheetsConstants::SPREADSHEET_CREDENTIALS, []);
    }
}
