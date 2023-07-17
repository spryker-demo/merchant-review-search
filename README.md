# Spryker Demo Packages

## Installation

### Add repository to composer as it is not registered in packagist.org

```
composer config repositories.spryker-demo-packages git git@github.com:spryker-projects/demo-packages-nonsplit.git
```

### Install feature

```
composer require spryker-demo/packages
```

### Override `TwigConfig`

```
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
