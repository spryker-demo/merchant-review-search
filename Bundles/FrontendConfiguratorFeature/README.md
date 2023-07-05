# Spryker Demo Frontend Configurator Feature

## Installation

### Add repositories to composer as they are not registered in packagist.org

```
composer config repositories.spryker-demo-frontend-configurator-feature path './demo-vendor/frontend-configurator-feature'
composer config repositories.spryker-demo-frontend-configurator path './demo-vendor/frontend-configurator'
composer config repositories.spryker-demo-frontend-configurator-gui path './demo-vendor/frontend-configurator-gui'
composer config repositories.spryker-demo-frontend-configurator-storage path './demo-vendor/frontend-configurator-storage'
composer config repositories.spryker-demo-frontend-configurator-widget path './demo-vendor/frontend-configurator-widget'
```

### Install feature

```
composer require spryker-demo/frontend-configurator-feature
```

### Add `SprykerDemo` namespace to configuration

```
$config[KernelConstants::CORE_NAMESPACES] = [
    ...
    'SprykerDemo',
];
```

### Adjust environment config with filesystem

```
# config/Shared/config_default.php

$config[FileSystemConstants::FILESYSTEM_SERVICE] = [
    ...
    'logo' => [
        'sprykerAdapterClass' => Aws3v3FilesystemBuilderPlugin::class,
        'root' => '',
        'path' => 'sc-b2b/yves/logo/',
        'key' => getenv('AWS_S3_KEY') ?? '',
        'secret' => getenv('AWS_S3_SECRET') ?? '',
        'bucket' => 'spryker-scb2b',
        'version' => '2006-03-01',
        'region' => 'eu-west-2',
    ],
    ...
];
```

### Wire filesystem reader, writer and stream plugins

```
# src/Pyz/Service/FileSystem/FileSystemDependencyProvider.php

use Spryker\Service\FileSystem\FileSystemDependencyProvider as SprykerFileSystemDependencyProvider;
use Spryker\Service\Flysystem\Plugin\FileSystem\FileSystemReaderPlugin;
use Spryker\Service\Flysystem\Plugin\FileSystem\FileSystemStreamPlugin;
use Spryker\Service\Flysystem\Plugin\FileSystem\FileSystemWriterPlugin;

class FileSystemDependencyProvider extends SprykerFileSystemDependencyProvider
{
    /**
     * @return \Spryker\Service\Flysystem\Plugin\FileSystem\FileSystemReaderPlugin
     */
    protected function getFileSystemReaderPlugin(): FileSystemReaderPlugin
    {
        return new FileSystemReaderPlugin();
    }

    /**
     * @return \Spryker\Service\Flysystem\Plugin\FileSystem\FileSystemWriterPlugin
     */
    protected function getFileSystemWriterPlugin(): FileSystemWriterPlugin
    {
        return new FileSystemWriterPlugin();
    }

    /**
     * @return \Spryker\Service\Flysystem\Plugin\FileSystem\FileSystemStreamPlugin
     */
    protected function getFileSystemStreamPlugin(): FileSystemStreamPlugin
    {
        return new FileSystemStreamPlugin();
    }
}
```

### Wire the Aws S3 plugin

```
# src/Pyz/Service/FlySystem/FlySystemDependencyProvider.php

use Spryker\Service\FlysystemAws3v3FileSystem\Plugin\Flysystem\Aws3v3FilesystemBuilderPlugin;
...
    protected function addFilesystemBuilderPluginCollection($container): Container
    {
        $container->set(static::PLUGIN_COLLECTION_FILESYSTEM_BUILDER, function (Container $container) {
            return [
                ...
                new Aws3v3FilesystemBuilderPlugin(),
                ...
            ];
        });

        return $container;
    }
```

### Wire the publisher plugins

```
# src/Pyz/Zed/Publisher/PublisherDependencyProvider.php

use SprykerDemo\Zed\FrontendConfiguratorStorage\Communication\Plugin\Publisher\FrontendConfigurator\FrontendConfiguratorStoragePublisherPlugin;
use SprykerDemo\Zed\FrontendConfiguratorStorage\Communication\Plugin\Publisher\FrontendConfiguratorPublisherTriggerPlugin;

    protected function getPublisherPlugins(): array
    {
        return array_merge(
            ...
            $this->getFrontendConfiguratorStoragePlugins(),
        );
    }

    public function getFrontendConfiguratorStoragePlugins(): array
    {
        return [
            new FrontendConfiguratorStoragePublisherPlugin(),
        ];
    }


```

### Wire the queue plugin

```
# src/Pyz/Zed/Queue/QueueDependencyProvider.php

use Spryker\Zed\Synchronization\Communication\Plugin\Queue\SynchronizationStorageQueueMessageProcessorPlugin;
use SprykerDemo\Zed\FrontendConfiguratorStorage\FrontendConfiguratorStorageConfig;

    protected function getProcessorMessagePlugins(Container $container): array
    {
        return [
            ...
            FrontendConfiguratorStorageConfig::FRONTEND_CONFIGURATOR_SYNC_STORAGE_QUEUE => new SynchronizationStorageQueueMessageProcessorPlugin(),
        ];
    }
```

### Wire the synchronization plugin

```
# src/Pyz/Zed/Synchronization/SynchronizationDependencyProvider.php

use SprykerDemo\Zed\FrontendConfiguratorStorage\Communication\Plugin\Synchronization\FrontendConfiguratorSynchronizationDataPlugin;

    protected function getSynchronizationDataPlugins(): array
    {
        return [
            ...
            new FrontendConfiguratorSynchronizationDataPlugin(),
        ];
    }
```

### Wire the twig extension plugin

```
# src/Pyz/Zed/Twig/TwigDependencyProvider.php

use SprykerDemo\Zed\FrontendConfiguratorGui\Communication\Plugin\Twig\Buttons\Form\BackofficeLogoTwigExtensionPlugin;

    protected function getTwigPlugins(): array
    {
        return [
            ...
            new BackofficeLogoTwigExtensionPlugin(),
        ];
    }
```

### Adjust navigation configuration file

```
# config/Zed/navigation.xml

<?xml version="1.0"?>
<config>
    <administration>
        <pages>
            ...
            <frontend-configurator-gui>
                <label>Frontend configurator Gui</label>
                <title>Frontend configurator Gui</title>
                <bundle>frontend-configurator-gui</bundle>
                <controller>index</controller>
                <action>edit</action>
            </frontend-configurator-gui>
        </pages>
    </administration>
</config>

```

### Adjust RabbitMq configuration

```
# src/Pyz/Client/RabbitMq/RabbitMqConfig.php

use SprykerDemo\Zed\FrontendConfiguratorStorage\FrontendConfiguratorStorageConfig;
...

protected function getPyzSynchronizationQueueConfiguration(): array
    {
        return [
            ...
            FrontendConfiguratorStorageConfig::FRONTEND_CONFIGURATOR_SYNC_STORAGE_QUEUE,
        ];
    }

```

### Apply Twig customization

```
# src/Pyz/Yves/CheckoutPage/Theme/default/templates/page-layout-checkout/page-layout-checkout.twig

                    {% block logo %}
                        <div class="col col--sm-4 text-center">
                            {% if findWidget('FrontendConfiguratorWidget') %}
                                {% set frontendConfiguratorWidget = findWidget('FrontendConfiguratorWidget') %}
                            {% endif %}

                            {% include molecule('logo') with {
                                attributes: {
                                    src: frontendConfiguratorWidget.data.logoUrl ?? null,
                                },
                            } only %}
                        </div>
                    {% endblock %}

# src/Pyz/Yves/ShopUi/Theme/automotive/components/organisms/header/header.twig

                {% block logo %}
                    {% include molecule('logo') with {
                        class: 'col ' ~  config.name ~ '__logo',
                        modifiers: ['main'],
                    } only %}
                {% endblock %}

#src/Pyz/Yves/ShopUi/Theme/cpg/components/organisms/header/header.twig

                 {% block logo %}
                     {% include molecule('logo') with {
                         class: 'col ' ~  config.name ~ '__logo',
                         modifiers: ['main'],
                     } only %}
                 {% endblock %}

#src/Pyz/Yves/ShopUi/Theme/default/components/organisms/header/header.twig

                 {% block logo %}
                     {% include molecule('logo') with {
                         class: 'col ' ~  config.name ~ '__logo',
                         modifiers: ['main'],
                     } only %}
                 {% endblock %}

#src/Pyz/Yves/ShopUi/Theme/default/templates/page-layout-main/page-layout-main.twig

{% block headStyles %}
    {{ parent() }}

    {% if findWidget('FrontendConfiguratorWidget') %}
        {% widget 'FrontendConfiguratorWidget' only %}{% endwidget %}
    {% endif %}
{% endblock %}
...
{% block body %}

    {% if findWidget('FrontendConfiguratorWidget') %}
        {% set frontendConfiguratorWidget = findWidget('FrontendConfiguratorWidget') %}
    {% endif %}
    ...
                 {% block logo %}
                     {% include molecule('logo') with {
                         class: 'col ' ~  config.name ~ '__logo',
                         modifiers: ['main'],
                         attributes: {
                             src: embed.logoSrc,
                         }
                     } only %}
                 {% endblock %}

#src/Pyz/Yves/ShopUi/Theme/industrial/components/organisms/header/header.twig

                {% block logo %}
                    {% include molecule('logo') with {
                        class: 'col ' ~  config.name ~ '__logo',
                        modifiers: ['main'],
                    } only %}
                {% endblock %}

#src/Pyz/Yves/ShopUi/Theme/services/components/organisms/header/header.twig

                {% block logo %}
                    {% include molecule('logo') with {
                        class: 'col ' ~  config.name ~ '__logo',
                        modifiers: ['main'],
                    } only %}
                {% endblock %}

#src/Pyz/Yves/ShopUi/Theme/wholesale-distribution/components/organisms/header/header.twig

                 {% block logo %}
                     {% include molecule('logo') with {
                         class: 'col ' ~  config.name ~ '__logo',
                         modifiers: ['main'],
                     } only %}
                 {% endblock %}

#src/Pyz/Zed/Gui/Presentation/Partials/menu.twig

{%- macro leaf(node, depth=0) -%}
    {%- import _self as menu -%}

    {%- if node is defined %}
        {%- if menu_highlight is defined -%}
            {%- if menu_highlight == node.uri -%}
                <li class="item active">
            {%- else -%}
                <li class="item">
            {%- endif -%}
        {%- else-%}
            <li class="item{{ node.is_active is defined and node.is_active ? " active" : "" }}">
        {%- endif -%}
        <a href="{{ node.uri }}"{% if node.shortcut is defined %} data-hotkey="{{ node.shortcut }}"{% endif %}>
            {{ menu.getNodeIcon(node) }}
            <span class="nav-label">{{ node.label | trans }}</span>
        </a>
        </li>
    {% endif -%}
{%- endmacro -%}

{%- macro branch(node, depth=0) -%}
    {%- import _self as menu -%}

    {%- if node is defined %}
        <li class="{{ node.is_active is defined and node.is_active ? " active" : "" }}">
            <a href="javascript:void(0)">
                {{ menu.getNodeIcon(node) }}
                <span class="nav-label">{{ node.label | trans }}</span>
                <span class="fa arrow"></span>
            </a>

            <ul class="nav nav-second-level collapse">
                {{ menu.tree(node.children, (depth + 1)) }}
            </ul>
        </li>
    {% endif -%}
{%- endmacro -%}

{%- macro tree(root) -%}
    {%- import _self as menu -%}

    {%- for child in root -%}
        {%- if child.children is defined and child.children is not empty -%}
            {{ menu.branch(child, 0) }}
        {%- else -%}
            {{ menu.leaf(child, 0) }}
        {%- endif -%}
    {%- endfor -%}
{%- endmacro -%}

{%- macro getNodeIcon(node) -%}
    {%- set defaultIcon = 'fa-angle-double-right' -%}
    {%- if node.icon is defined and node.icon != '' -%}
        <i class="fa {{ node.icon }}"></i>
    {%- else -%}
        <i class="fa {{ defaultIcon }}"></i>
    {%- endif -%}
{%- endmacro -%}

{%- import _self as menu -%}
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul tabindex="0" class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">

                    {{ backofficeLogo() }}

                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="/auth/logout">{{ 'Logout' | trans }}</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    SP
                </div>
            </li>
            {{ menu.tree(navigation.menu) }}
        </ul>
    </div>
</nav>

#src/Pyz/Zed/Gui/Presentation/Partials/backoffice-logo.twig

{% if not backofficeLogoUrl is empty %}
     <style>
         .zed-logo {
             background: center/contain no-repeat url("{{ backofficeLogoUrl }}");
         }
     </style>
 {% endif %}
 <a href="/" class="{{ class }} zed-logo"></a>

#src/Pyz/Zed/SecurityGui/Presentation/Layout/layout.twig

<!DOCTYPE html>
 <html>
 <head>

     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <title>{% block head_title %}{% if title is defined %}{{ title | trans }}{% endif %}{% endblock %}</title>

     {% block head_css %}
         <link rel="stylesheet" href="{{ assetsPath('css/spryker-zed-gui-commons.css') }}">
         <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
     {% endblock %}

 </head>
 <body class="login">

 <div class="login__wrapper">
     <div class="login__container">
         {{ backofficeLogo('login__logo') }}

         {% include '@Messenger/Partials/flash-messages.twig' %}

         <div class="login-box">
             {% block login_heading %}
                 <div class="login-box__heading">
                     <h1 class="login-box__title">{{ 'Login' | trans }}</h1>
                 </div>
             {% endblock %}
             <div class="login-box__content">
                 {% block content %}{% endblock %}
             </div>
         </div>
     </div>
 </div>

 {% block footer_js %}
     <script src="{{ assetsPath('js/spryker-zed-gui-commons.js') }}"></script>
 {% endblock %}

 </body>
 </html>
```

### Add behaviors to the database definition schemas
```
#src/Pyz/Zed/FrontendConfigurator/Persistence/Propel/Schema/spy_frontend_configurator.schema.xml

<?xml version="1.0"?>
 <database xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           name="zed"
           xsi:noNamespaceSchemaLocation="http://static.spryker.com/schema-01.xsd"
           namespace="Orm\Zed\FrontendConfigurator\Persistence"
           package="src.Orm.Zed.FrontendConfigurator.Persistence">

     <table name="spy_frontend_configurator">
         <behavior name="event">
             <parameter name="spy_frontend_configurator_all" column="*"/>
         </behavior>
     </table>

 </database>

 #src/Pyz/Zed/FrontendConfiguratorStorage/Persistence/Propel/Schema/spy_frontend_configurator_storage.schema.xml

 <?xml version="1.0"?>
 <database xmlns="spryker:schema-01"
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           name="zed"
           xsi:schemaLocation="spryker:schema-01 https://static.spryker.com/schema-01.xsd"
           namespace="Orm\Zed\FrontendConfiguratorStorage\Persistence"
           package="src.Orm.Zed.FrontendConfiguratorStorage.Persistence">

     <table name="spy_frontend_configurator_storage" identifierQuoting="true">
         <behavior name="synchronization">
             <parameter name="resource" value="frontend_configurator"/>
             <parameter name="queue_group" value="sync.storage.frontend_configurator"/>
             <parameter name="key_suffix_column" value="fk_frontend_configurator"/>
         </behavior>
     </table>
 </database>
```
