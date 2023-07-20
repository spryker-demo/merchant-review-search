# Spryker Demo Packages

## Installation

### Add repository to composer as it is not registered in packagist.org

```bash
composer config repositories.spryker-demo-packages git git@github.com:spryker-projects/demo-packages-nonsplit.git
```

### Install feature package

```bash
composer require spryker-demo/packages
```

### Install Composer merge plugin

#### Install the plugin package

```bash
composer require "wikimedia/composer-merge-plugin:^2.0"
```

Select `y` when asked whether to enable the plugin.

#### Configure the plugin

```bash
composer config --json extra.merge-plugin '{"include": ["vendor/spryker/spryker-demo/Bundles/*/composer.json"], "ignore-duplicates": true}'
```

### Add `SprykerDemo` namespace to project configuration

```php
# config/Shared/config_default.php

$config[KernelConstants::CORE_NAMESPACES] = [
    ...
    'SprykerDemo',
];
```

### Override `TwigConfig`

```php
# src/Pyz/Yves/Twig/TwigConfig.php

class TwigConfig extends SprykerTwigConfig
{
    /**
     * @param array<string> $paths
     *
     * @return array<string>
     */
    protected function addCoreTemplatePaths(array $paths)
    {
        $paths = parent::addCoreTemplatePaths($paths);
        $namespaces = $this->getCoreNamespaces();

        foreach ($namespaces as $namespace) {
            if ($namespace == 'SprykerDemo') {
                $paths[] = rtrim(APPLICATION_VENDOR_DIR, DIRECTORY_SEPARATOR) . '/*/*/Bundles/*/src/' . $namespace . '/Yves/%s/Theme/' . $this->getThemeNameDefault();
                $paths[] = rtrim(APPLICATION_VENDOR_DIR, DIRECTORY_SEPARATOR) . '/*/*/Bundles/*/src/' . $namespace . '/Shared/%s/Theme/' . $this->getThemeNameDefault();
            }
        }

        return $paths;
    }
}
```

### Override `PropelConfig`

```php
# src/Pyz/Zed/Propel/PropelConfig.php

class PropelConfig extends SprykerPropelConfig
{
    /**
     * @return array<string>
     */
    public function getCorePropelSchemaPathPatterns(): array
    {
        $corePropelSchemaPathPatterns = parent::getCorePropelSchemaPathPatterns();
        $demoPropelSchemaPathPattern = APPLICATION_VENDOR_DIR . '/spryker/spryker-demo/Bundles/*/src/*/Zed/*/Persistence/Propel/Schema/';

        if (count(glob($demoPropelSchemaPathPattern)) === 0) {
            return $corePropelSchemaPathPatterns;
        }

        return array_merge(
            $corePropelSchemaPathPatterns,
            [$demoPropelSchemaPathPattern],
        );
    }
}
```

### Override `TransferConfig`

```php
# src/Pyz/Zed/Transfer/TransferConfig.php

class TransferConfig extends SprykerTransferConfig
{
    /**
     * @return array<string>
     */
    protected function getCoreSourceDirectoryGlobPatterns(): array
    {
        $directoryGlobPatterns = parent::getCoreSourceDirectoryGlobPatterns();
        $directoryGlobPatterns[] = APPLICATION_VENDOR_DIR . '/spryker/spryker-demo/Bundles/*/src/SprykerDemo/Shared/*/Transfer/';

        return $directoryGlobPatterns;
    }

    ...
}
```

### Override `TranslatorConfig`

```php
# src/Pyz/Zed/Translator/TranslatorConfig.php

<?php

namespace Pyz\Zed\Translator;

use Spryker\Zed\Translator\TranslatorConfig as SprykerTranslatorConfig;

class TranslatorConfig extends SprykerTranslatorConfig
{
    public function getCoreTranslationFilePathPatterns(): array
    {
        $coreTranslationFilePathPatterns = parent::getCoreTranslationFilePathPatterns();
        $coreTranslationFilePathPatterns[] = APPLICATION_VENDOR_DIR . '/spryker/spryker-demo/Bundles/*/data/translation/Zed/[a-z][a-z]_[A-Z][A-Z].csv';

        return $coreTranslationFilePathPatterns;
    }

    ...
}

```
### Frontend config

#### frontend/settings.js
```js

const paths = {

    // demo folders
    demo: globalSettings.paths.demo,
};

// define global settings
const globalSettings = {

    paths: {


        // demo folders
        demo: '/vendor/spryker/spryker-demo',
    },

};

// return settings
return {
    // define settings for suite-frontend-builder finder
    find: {
        // entry point patterns (components)
        componentEntryPoints: {
            // absolute dirs in which look for
            dirs: [
                join(globalSettings.context, paths.demo),
            ],
        }
    }
};
```
