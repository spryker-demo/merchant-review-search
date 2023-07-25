# ImportProcessFeature Module
[![Latest Stable Version](https://poser.pugx.org/spryker-demo/import-process-feature/v/stable.svg)](https://packagist.org/packages/spryker-demo/import-process-feature)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg)](https://php.net/)

Import Process Feature

## Installation

### Add repositories to composer as they are not registered in packagist.org

```
composer config repositories.spryker-demo-import-process-feature vsc 'https://github.com/spryker-projects/import-process-feature.git'
composer config repositories.spryker-demo-import-process vsc 'https://github.com/spryker-projects/import-process.git'
composer config repositories.spryker-demo-import-process-gui vsc 'https://github.com/spryker-projects/import-process-gui.git'
composer config repositories.spryker-demo-import-process-google-sheets vsc 'https://github.com/spryker-projects/import-process-google-sheets.git'
composer config repositories.spryker-demo-import-process-google-sheets-gui vsc 'https://github.com/spryker-projects/import-process-google-sheets-gui.git'
```

### Install feature

```
composer require spryker-demo/import-process-feature
```

### Add `SprykerDemo` namespace and Google Sheets API credentials to configuration

```
use SprykerDemo\Service\GoogleSheets\GoogleSheetsConfig;
use SprykerDemo\Shared\GoogleSheets\GoogleSheetsConstants;
...

$config[KernelConstants::CORE_NAMESPACES] = [
    ...
    'SprykerDemo',
];
...

$config[GoogleSheetsConstants::GOOGLE_SHEETS_CREDENTIALS] = [
    GoogleSheetsConfig::CREDENTIAL_FIELD_TYPE => 'service_account',
    GoogleSheetsConfig::CREDENTIAL_FIELD_PROJECT_ID => getenv('SPRYKER_GOOGLE_SHEETS_PROJECT_ID'),
    GoogleSheetsConfig::CREDENTIAL_FIELD_PRIVATE_KEY_ID => getenv('SPRYKER_GOOGLE_SHEETS_PRIVATE_KEY_ID'),
    GoogleSheetsConfig::CREDENTIAL_FIELD_PRIVATE_KEY => getenv('SPRYKER_GOOGLE_SHEETS_PRIVATE_KEY'),
    GoogleSheetsConfig::CREDENTIAL_FIELD_CLIENT_EMAIL => getenv('SPRYKER_GOOGLE_SHEETS_CLIENT_EMAIL'),
    GoogleSheetsConfig::CREDENTIAL_FIELD_CLIENT_ID => getenv('SPRYKER_GOOGLE_SHEETS_CLIENT_ID'),
    GoogleSheetsConfig::CREDENTIAL_FIELD_AUTH_URI => 'https://accounts.google.com/o/oauth2/auth',
    GoogleSheetsConfig::CREDENTIAL_FIELD_TOKEN_URI => 'https://oauth2.googleapis.com/token',
    GoogleSheetsConfig::CREDENTIAL_FIELD_AUTH_PROVIDER_X_509_CERT_URL => 'https://www.googleapis.com/oauth2/v1/certs',
    GoogleSheetsConfig::CREDENTIAL_FIELD_CLIENT_X_509_CERT_URL => getenv('SPRYKER_GOOGLE_SHEETS_CLIENT_X_509_CERT_URL'),
];
```

Make sure to also set the needed environment variables.

### Build transfers

```
console transfer:generate
```

### Wire event plugin

```
# src/Pyz/Zed/Event/EventDependencyProvider.php

use SprykerDemo\Zed\ImportProcess\Communication\Plugin\Event\Subscriber\ImportProcessEventSubscriber;

// ...

public function getEventSubscriberCollection(): EventSubscriberCollectionInterface
{
    // ...
    $eventSubscriberCollection->add(new ImportProcessEventSubscriber());
});

```

### Wire import process plugins

```
# src/Pyz/Zed/ImportProcess/ImportProcessDependencyProvider.php

use SprykerDemo\Zed\ImportProcess\ImportProcessDependencyProvider as SprykerDemoImportProcessDependencyProvider;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Communication\Plugin\ImportProcess\ImportProcessSpreadsheetPayloadCleanupPlugin;
use SprykerDemo\Zed\ImportProcessSpreadsheet\Communication\Plugin\ImportProcess\ImportProcessSpreadsheetPayloadDownloadPlugin;

// ...

protected function getImportProcessPreExecutePlugins(): array
{
    return [
        // ...
        new ImportProcessSpreadsheetPayloadDownloadPlugin(),
    ];
}

protected function getImportProcessPostExecutePlugins(): array
{
    return [
        // ...
        new ImportProcessSpreadsheetPayloadCleanupPlugin(),
    ];
}

```

### Adjust Navigation configuration file

```
<?xml version="1.0"?>
<config>
    ...
    <administration>
        ...
        <pages>
            ...
            <import-process-gui>
                <label>Import processes</label>
                <title>Import processes</title>
                <bundle>import-process-gui</bundle>
                <controller>index</controller>
                <action>index</action>
            </import-process-gui>
        </pages>
    </administration>
</config>
```

### Apply Twig customization

```
# src/Pyz/Zed/ProductManagement/Presentation/Index/index.twig

{% block action %}
    {{ createActionButton('/import-process-spreadsheet-gui/index/select-sheet', 'Product Import from Spreadsheet' | trans) }}
    ...
{% endblock %}
```

### Add `synchronization` Propel behavior

```
<?xml version="1.0"?>
<database xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          name="zed"
          xsi:noNamespaceSchemaLocation="http://static.spryker.com/schema-01.xsd"
          namespace="Orm\Zed\ImportProcess\Persistence"
          package="src.Orm.Zed.ImportProcess.Persistence">

    <table name="spy_import_process">
        <behavior name="event">
            <parameter name="spy_import_process_create" column="*"/>
        </behavior>
    </table>

</database>
```

### Build Propel classes

```
console propel:install
```

### Generate Backoffice translations

```
console translator:generate-cache
```

### Build Backoffice frontend

```
frontend:zed:install-dependencies
frontend:zed:build
```
