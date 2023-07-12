# Company Representative Feature Module
[![Latest Stable Version](https://poser.pugx.org/spryker-demo/company-representative-feature/v/stable.svg)](https://packagist.org/packages/spryker-demo/company-representative-feature)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg)](https://php.net/)

Provides logic for saving and reading company representatives.

###  Install the required modules using Composer

```
composer require spryker-demo/company-representative-feature
```


### Add `SprykerDemo` namespace to configuration

```
$config[KernelConstants::CORE_NAMESPACES] = [
    ...
    'SprykerDemo',
];
```

### Add translations

```
# data/import/common/common/glossary.csv
customer.representative.services.title,Customer service representative,en_US
customer.representative.services.title,Kundenbetreuer,de_DE
company.account.customer.service.empty,"No Customer Service Representative.",en_US
company.account.customer.service.empty,"Kein Kundendienstmitarbeiter.",de_DE
```

### Import translations

```
console data:import:glossary
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
#### src/Pyz/Yves/CompanyPage/CompanyPageDependencyProvider.php
```php
<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CompanyPage;

use SprykerDemo\Yves\CustomerRepresentativeWidget\Widget\CustomerRepresentativeWidget;
use SprykerShop\Yves\CompanyPage\CompanyPageDependencyProvider as SprykerCompanyPageDependencyProvider;

class CompanyPageDependencyProvider extends SprykerCompanyPageDependencyProvider
{
    /**
     * @return array
     */
    protected function getCompanyOverviewWidgetPlugins(): array
    {
        return [
            CustomerRepresentativeWidget::class,
        ];
    }
}
```

#### src/Pyz/Yves/CompanyPage/Theme/default/views/overview/overview.twig
```html
  {% if widgetExists('CustomerRepresentativeWidget') %}
    {% widget 'CustomerRepresentativeWidget' only %}{% endwidget %}
  {% endif %}
```
#### src/Pyz/Yves/ShopUi/Theme/default/components/atoms/icon-sprite/icon-sprite.twig
```svg
<symbol id=":customer-representative" viewBox="0 0 33 33">
            <title id=":customer-representative">Customer Representative</title>
            <path d="M30.884 14.0965C30.7418 10.3091 29.1595 6.72512 26.4695 4.09659C23.7795 1.46818 20.1909 0 16.4569 0C12.7232 0 9.13505 1.46824 6.44482 4.09659C3.7546 6.72494 2.17249 10.3091 2.03009 14.0965C1.42819 14.3653 0.915749 14.8058 0.555294 15.3645C0.195091 15.9232 0.00210445 16.576 0 17.2436V21.1098C0 22.0237 0.357625 22.8999 0.993949 23.5461C1.6305 24.1922 2.49405 24.5553 3.39405 24.5553C3.97627 24.5553 4.53459 24.3208 4.9466 23.9036C5.3588 23.4862 5.59089 22.9201 5.59233 22.3291V16.0295C5.58952 15.478 5.3853 14.9471 5.019 14.5399C4.65247 14.1324 4.15012 13.8778 3.60932 13.825C3.74352 10.4559 5.15624 7.27042 7.5519 4.93463C9.9478 2.59914 13.1407 1.29491 16.4625 1.29491C19.7842 1.29491 22.9774 2.59914 25.3726 4.93463C27.7685 7.27036 29.1812 10.456 29.3154 13.825C28.7749 13.8778 28.2732 14.1326 27.9077 14.5401C27.5423 14.9476 27.339 15.4785 27.3376 16.0295V22.3291C27.3409 22.8857 27.5486 23.4206 27.9203 23.8294C28.292 24.2383 28.8009 24.4913 29.3468 24.5391V26.1366C29.3454 26.9977 29.0079 27.8234 28.4082 28.4322C27.8081 29.041 26.995 29.3836 26.1467 29.385H23.744C23.6363 29.0465 23.4571 28.7358 23.2194 28.4745C22.7737 28.0195 22.1674 27.7646 21.5355 27.7663H19.0749C18.7304 27.7644 18.3899 27.8407 18.0782 27.99C17.421 28.3028 16.9404 28.9029 16.7725 29.6199C16.6048 30.3366 16.7683 31.0921 17.2166 31.6718C17.6648 32.2511 18.3492 32.5915 19.075 32.5963H21.5195C22.0093 32.5946 22.4866 32.4406 22.8871 32.1548C23.2878 31.869 23.5923 31.4656 23.7597 30.9987H26.1311C27.3967 30.9973 28.6104 30.4862 29.5052 29.5778C30.4003 28.6691 30.9036 27.4374 30.905 26.1528V24.2675C31.5027 23.9963 32.0105 23.5555 32.3672 22.998C32.7236 22.4405 32.9136 21.7903 32.9143 21.1256V17.2434C32.9115 16.5759 32.7183 15.9235 32.3581 15.3649C31.9976 14.8064 31.4859 14.3659 30.884 14.0963L30.884 14.0965ZM4.01835 16.0295V22.3291C4.01554 22.6771 3.73684 22.9576 3.39397 22.9576C2.91127 22.9576 2.44828 22.7629 2.10677 22.4163C1.76554 22.0697 1.57373 21.5997 1.57373 21.1097V17.2435C1.57513 16.754 1.76718 16.2847 2.10842 15.9386C2.44942 15.5922 2.91171 15.3973 3.39393 15.3958C3.73751 15.3987 4.01549 15.6806 4.01831 16.0294L4.01835 16.0295ZM22.2959 30.3492C22.2168 30.7267 21.8891 30.9972 21.509 30.9989H19.0747C18.6285 30.9989 18.2666 30.6316 18.2666 30.1787C18.2666 29.7258 18.6285 29.3585 19.0747 29.3585H21.5192C21.7347 29.3585 21.941 29.4469 22.0912 29.6036C22.2434 29.755 22.3284 29.9623 22.3272 30.1787C22.3223 30.2364 22.3118 30.2935 22.2959 30.3491L22.2959 30.3492ZM31.3295 21.11C31.3295 21.6 31.1377 22.07 30.7964 22.4166C30.455 22.7633 29.9919 22.958 29.5092 22.958C29.1664 22.958 28.8877 22.6774 28.8849 22.3294V16.0298C28.8877 15.6811 29.1657 15.3991 29.5092 15.3963C29.9915 15.3977 30.4538 15.5926 30.7947 15.939C31.136 16.2852 31.328 16.7544 31.3294 17.2439L31.3295 21.11Z" fill="currentColor"/>
            <path d="M21.1034 20.2829C21.7988 20.2829 22.4656 20.0019 22.9576 19.5014C23.4496 19.001 23.7266 18.3221 23.7277 17.614V12.1502C23.7277 11.4415 23.4511 10.7621 22.9589 10.2615C22.4665 9.76088 21.7991 9.48017 21.1034 9.48133H13.0908C12.3954 9.48133 11.7286 9.76221 11.2367 10.2626C10.7446 10.7631 10.4676 11.4419 10.4665 12.1502V17.6141C10.4676 18.3222 10.7447 19.001 11.2367 19.5015C11.7287 20.0019 12.3954 20.283 13.0908 20.283H13.1404L13.1402 21.7161C13.1391 21.9769 13.2146 22.2321 13.3573 22.4486C13.5001 22.6652 13.7033 22.8331 13.9407 22.9308C14.1748 23.0288 14.4323 23.0532 14.6803 23.0008C14.928 22.9485 15.1548 22.8214 15.3313 22.6366L17.6336 20.304L21.1034 20.2829ZM16.9404 19.1943L14.4647 21.7161C14.4647 21.7161 14.4647 21.7371 14.4234 21.7161C14.4039 21.7101 14.3916 21.6904 14.3945 21.6699V19.6525C14.3945 19.3042 14.1175 19.022 13.7756 19.022H13.0908C12.7237 19.022 12.3717 18.8738 12.1119 18.6098C11.852 18.3458 11.7054 17.9878 11.7043 17.6141V12.1502C11.7054 11.7763 11.852 11.4183 12.1119 11.1543C12.3717 10.8903 12.7237 10.7423 13.0908 10.7423H21.1034C21.4705 10.7423 21.8225 10.8903 22.0822 11.1543C22.3421 11.4183 22.4888 11.7763 22.4899 12.1502V17.6141C22.4888 17.9878 22.3421 18.3458 22.0822 18.6098C21.8225 18.8738 21.4705 19.022 21.1034 19.022H17.3899C17.2234 19.0153 17.0613 19.0776 16.9403 19.1943L16.9404 19.1943Z" fill="currentColor"/>
            <path d="M14.0891 14.0625C13.8476 14.0636 13.6163 14.1623 13.4461 14.337C13.2759 14.5117 13.1806 14.7479 13.1814 14.9941C13.1821 15.2401 13.2788 15.4759 13.4499 15.6495C13.6212 15.8233 13.8531 15.9205 14.0946 15.9201C14.3363 15.9197 14.5678 15.8218 14.7386 15.6476C14.9093 15.4735 15.0051 15.2375 15.0051 14.9913C15.0051 14.7442 14.9086 14.5074 14.7366 14.3331C14.5647 14.1588 14.3317 14.0614 14.0891 14.0625V14.0625Z" fill="currentColor"/>
            <path d="M17.0971 14.0625C16.8553 14.0625 16.6234 14.1603 16.4524 14.3346C16.2813 14.5087 16.1853 14.7449 16.1853 14.9913C16.1853 15.2377 16.2813 15.4739 16.4524 15.648C16.6234 15.8223 16.8553 15.9201 17.0971 15.9201C17.339 15.9201 17.5709 15.8223 17.7418 15.648C17.913 15.4739 18.0089 15.2377 18.0089 14.9913C18.0089 14.7449 17.913 14.5087 17.7418 14.3346C17.5709 14.1603 17.339 14.0625 17.0971 14.0625Z" fill="currentColor"/>
            <path d="M20.1009 14.0625C19.8594 14.0636 19.6281 14.1623 19.4579 14.337C19.2877 14.5117 19.1924 14.7479 19.1932 14.9941C19.1939 15.2401 19.2904 15.4759 19.4617 15.6495C19.633 15.8233 19.8648 15.9205 20.1064 15.9201C20.3481 15.9197 20.5796 15.8218 20.7504 15.6476C20.921 15.4735 21.0169 15.2375 21.0169 14.9913C21.0158 14.7446 20.9189 14.5083 20.7473 14.3342C20.5756 14.1601 20.3431 14.0625 20.1009 14.0625L20.1009 14.0625Z" fill="currentColor"/>
        </symbol>
```
### Zed config
#### src/Pyz/Zed/Company/CompanyDependencyProvider.php
````php
<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Company;

use Spryker\Zed\Company\CompanyDependencyProvider as SprykerCompanyDependencyProvider;
use Spryker\Zed\CompanyBusinessUnit\Communication\Plugin\Company\CompanyBusinessUnitCreatePlugin;
use Spryker\Zed\CompanyMailConnector\Communication\Plugin\Company\SendCompanyStatusChangePlugin;
use Spryker\Zed\CompanyRole\Communication\Plugin\CompanyRoleCreatePlugin;
use Spryker\Zed\CompanyUser\Communication\Plugin\Company\CompanyUserCreatePlugin;
use SprykerDemo\Zed\CompanyRepresentative\Communication\Plugin\Company\SaveCompanyRepresentativePlugin;

class CompanyDependencyProvider extends SprykerCompanyDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\CompanyExtension\Dependency\Plugin\CompanyPostSavePluginInterface>
     */
    protected function getCompanyPostSavePlugins(): array
    {
        return [
            new SaveCompanyRepresentativePlugin(),
        ];
    }
}
````
#### src/Pyz/Zed/CompanyGui/CompanyGuiDependencyProvider.php
```php
<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyGui;

use Spryker\Zed\CompanyGui\CompanyGuiDependencyProvider as SprykerCompanyGuiDependencyProvider;
use SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Plugin\CompanyCustomerRepresentativesTypeFieldPlugin;
use SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Plugin\CompanyTableCustomerRepresentativesDataExpanderPlugin;
use SprykerDemo\Zed\CompanyRepresentativeGui\Communication\Plugin\CompanyTableCustomerRepresentativesHeaderExpanderPlugin;

class CompanyGuiDependencyProvider extends SprykerCompanyGuiDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\CompanyGuiExtension\Dependency\Plugin\CompanyFormExpanderPluginInterface>
     */
    protected function getCompanyFormPlugins(): array
    {
        return [
            new CompanyCustomerRepresentativesTypeFieldPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\CompanyGuiExtension\Dependency\Plugin\CompanyTableHeaderExpanderPluginInterface>
     */
    protected function getCompanyTableHeaderExpanderPlugins(): array
    {
        return [
            new CompanyTableCustomerRepresentativesHeaderExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\CompanyGuiExtension\Dependency\Plugin\CompanyTableDataExpanderPluginInterface>
     */
    protected function getCompanyTableDataExpanderPlugins(): array
    {
        return [
            new CompanyTableCustomerRepresentativesDataExpanderPlugin(),
        ];
    }
}

```
####
