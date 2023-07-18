# ImportProcessFeature Module
[![Latest Stable Version](https://poser.pugx.org/spryker-demo/import-process-feature/v/stable.svg)](https://packagist.org/packages/spryker-demo/import-process-feature)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg)](https://php.net/)

Import Process Feature

## Installation

### Add repositories to composer as they are not registered in packagist.org

```
composer config repositories.spryker-demo-import-process-feature vsc 'https://github.com/spryker-projects/import-process-feature.git'
composer config repositories.spryker-demo-import-process-feature vsc 'https://github.com/spryker-projects/import-process.git'
composer config repositories.spryker-demo-import-process-feature vsc 'https://github.com/spryker-projects/import-process-gui.git'
composer config repositories.spryker-demo-import-process-feature vsc 'https://github.com/spryker-projects/import-process-google-sheets.git'
composer config repositories.spryker-demo-import-process-feature vsc 'https://github.com/spryker-projects/import-process-google-sheets-gui.git'
```

### Install feature

```
composer require spryker-demo/import-process-feature
```

### Add `SprykerDemo` namespace to configuration

```
$config[KernelConstants::CORE_NAMESPACES] = [
    ...
    'SprykerDemo',
];
```

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

### Generate Backoffice translations

```
console translator:generate-cache
```

### Build Backoffice frontend

```
frontend:zed:install-dependencies
frontend:zed:build
```
