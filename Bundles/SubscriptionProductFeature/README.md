# Spryker Demo Subscription Product Feature

## Installation

### Add repositories to composer as they are not registered in packagist.org

```
composer config repositories.spryker-demo-subscription-product-feature path './demo-vendor/subscription-product-feature'
composer config repositories.spryker-demo-subscription-product-oms path './demo-vendor/subscription-product-oms'
composer config repositories.spryker-demo-subscription-product-page path './demo-vendor/subscription-product-page'
```

### Install feature

```
composer require spryker-demo/subscription-product-feature
```

### Add `SprykerDemo` namespace to configuration

```
$config[KernelConstants::CORE_NAMESPACES] = [
    ...
    'SprykerDemo',
];
```

### Wire the router provider plugin

```
# src/Pyz/Yves/Router/RouterDependencyProvider.php

use SprykerDemo\Yves\SubscriptionProductPage\Plugin\Router\SubscriptionProductPageRouteProviderPlugin;
...

protected function getRouteProvider(): array
{
    return [
        ...
        new SubscriptionProductPageRouteProviderPlugin(),
    ];
}
```

### Wire the oms command and conditions plugin

```
# src/Pyz/Zed/Oms/OmsDependencyProvider.php

use SprykerDemo\Zed\SubscriptionProductOms\Communication\Plugin\Oms\Command\SendCanceledSubscriptionNotificationPlugin;
use SprykerDemo\Zed\SubscriptionProductOms\Communication\Plugin\Oms\Condition\IsPaymentReminderLimitReachedPlugin;
use SprykerDemo\Zed\SubscriptionProductOms\Communication\Plugin\Oms\Condition\IsSubscriptionPlugin;

// ...

protected function extendCommandPlugins(Container $container): Container
{
    $container->extend(self::COMMAND_PLUGINS, function (CommandCollectionInterface $commandCollection) {
        $commandCollection->add(new SendCanceledSubscriptionNotificationPlugin(), 'Subscription/SendCanceledSubscriptionNotification');

        return $commandCollection;
});

// ...

protected function extendConditionPlugins(Container $container): Container
{
    $container->extend(self::CONDITION_PLUGINS, function (ConditionCollectionInterface $conditionCollection) {
        $conditionCollection->add(new IsPaymentReminderLimitReachedPlugin(), 'Subscription/isSubscriptionInvoiceIntervalReached');
        $conditionCollection->add(new IsSubscriptionPlugin(), 'Subscription/IsSubscription');

        return $conditionCollection;
    });

    return $container;
}
```

### Adjust OMS configuration file

```
# if installed using demo-packages repo
cp vendor/spryker-demo/packages/Bundles/SubscriptionProductOms/config/Zed/oms/SubscriptionSubprocess/DummySubscription01.xml config/Zed/oms/SubscriptionSubprocess/DummySubscription01.xml
# if installed using feature repo
cp vendor/spryker-demo/subscription-product-oms/config/Zed/oms/SubscriptionSubprocess/DummySubscription01.xml config/Zed/oms/SubscriptionSubprocess/DummySubscription01.xml
```
```
# config/Zed/oms/DummyPayment01.xml

<?xml version="1.0"?>
<statemachine
    xmlns="spryker:oms-01"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="spryker:oms-01 http://static.spryker.com/oms-01.xsd">

    <process name="DummyPayment01" main="true">
        <subprocesses>
            ...
            <process>Subscription</process>
        </subprocesses>
        ...

    <process name="Subscription" file="SubscriptionSubprocess/DummySubscription01.xml"/>
</statemachine>
```

### Add translations

```
# data/import/common/common/glossary.csv

product.cancel_subscription.success_message,Das Abonnement für Produkt %product% wurde erfolgreich gekündigt,de_DE
product.cancel_subscription.success_message,Subscription for product %product% has been successfully canceled,en_US
product.cancel_subscription.error_message,Das Abonnement für diesen Bestellartikel kann nicht gekündigt werden!,de_DE
product.cancel_subscription.error_message,Can't cancel subscription for this order item!,en_US
product.cancel_subscription.warning_message,Abonnement bereits gekündigt!,de_DE
product.cancel_subscription.warning_message,Subscription already cancelled!,en_US
oms.state.subscription-active,Abonnement aktiv,de_DE
oms.state.subscription-active,Subscription Active,en_US
oms.state.subscription-cancelled,Abonnement gekündigt,de_DE
oms.state.subscription-cancelled,Subscription Cancelled,en_US
customer.account.subscriptions,Abonnements,de_DE
customer.account.subscriptions,Subscriptions,en_US
product.subscription.subscription_id,Referenz,de_DE
product.subscription.subscription_id,Reference,en_US
product.subscription.interval,Intervall,de_DE
product.subscription.interval,Interval,en_US
product.subscription.date,Datum,de_DE
product.subscription.date,Date,en_US
product.subscription.total,Summe,de_DE
product.subscription.total,Total,en_US
product.subscription.item_state,Stand,de_DE
product.subscription.item_state,State,en_US
product.subscription.item_name,Artikelname,de_DE
product.subscription.item_name,Name,en_US
product.subscription.actions,Actions,en_US
product.subscription.actions,Aktion,de_DE
customer.account.no_subscriptions,Derzeit keine Abonnements,de_DE
customer.account.no_subscriptions,No subscriptions at the moment,en_US
```

### Import translations

```
console data:import:glossary
```

### Apply Twig customization

#### B2C Marketplace
```
# src/Pyz/Yves/CustomerPage/Theme/default/components/molecules/customer-navigation/customer-navigation.twig

{% block body %}
    <ul class="{{ component.renderClass('menu', modifiers) }}">

        <!-- ... -->

        <li class="{{ component.renderClass('menu__item', modifiers) }} {{macros.isActive('order', data.activePage)}}">
            <a class="{{ component.renderClass('menu__link', modifiers) }}" href="{{ path('subscription-product') }}"
               data-id="sidebar-order">{{ 'customer.account.subscriptions' | trans }}</a>
        </li>
```


#### B2B Marketplace
```
# src/Pyz/Yves/ShopUi/Theme/default/components/molecules/user-navigation/user-navigation.twig

{% include molecule('navigation-list') with {
            modifiers: ['secondary'],
            class: config.name ~ '__sub-nav',
            data: {
                nodes: [
                // ...
                {
                    url: url('subscription-product'),
                    title: 'customer.account.subscriptions' | trans,
                },
                // ...
            ]},
        } only %}

```

```
# src/Pyz/Yves/CustomerPage/Theme/default/components/molecules/navigation-sidebar/navigation-sidebar.twig

{% define data = {
    items: [
        // ...

        {
            name: 'subscription',
            url: path('subscription-product'),
            label: 'customer.account.subscriptions' | trans,
            icon: 'subscribe',
        },

        // ...
    ]
} %}
```


### Install sample data (optional)

```
composer require spryker-demo/subscription-product-data-import
```

Sample data for the following entities is provided by the previous composer package:

#### product-attribute-key

* File: `vendor/spryker-demo/subscription-product-data-import/data/import/product_attribute_key.csv`
* Command: `console data:import:product-attribute-key`

#### product-management-attribute

* File: `vendor/spryker-demo/subscription-product-data-import/data/import/product_management_attribute.csv`
* Command: `console data:import:product-management-attribute`

#### product-abstract

* File: `vendor/spryker-demo/subscription-product-data-import/data/import/product_abstract.csv`
* Command: `console data:import:product-abstract`

#### product-concrete

* File: `vendor/spryker-demo/subscription-product-data-import/data/import/product_concrete.csv`
* Command: `console data:import:product-concrete`

#### product-image

* File: `vendor/spryker-demo/subscription-product-data-import/data/import/product_image.csv`
* Command: `console data:import:product-image`

#### product-price

* File: `vendor/spryker-demo/subscription-product-data-import/data/import/DE/product_price.csv`
* Command: `console data:import:product-price`

#### product-abstract-store

* File: `vendor/spryker-demo/subscription-product-data-import/data/import/DE/product_abstract_store.csv`
* Command: `console data:import:product-abstract-store`

#### product-stock

* File: `vendor/spryker-demo/subscription-product-data-import/data/import/product_stock.csv`
* Command: `console data:import:product-stock`

#### merchant-product

* File: `vendor/spryker-demo/subscription-product-data-import/data/import/merchant_product.csv`
* Command: `console data:import:merchant-product`

#### product-approval-status

* File: `vendor/spryker-demo/subscription-product-data-import/data/import/product_abstract_approval_status.csv`
* Command: `console data:import:product-approval-status`

#### product-price-merchant-relationship (only if installed in a marketplace scenario)

* File: `vendor/spryker-demo/subscription-product-data-import/data/import/DE/price_product_merchant_relationship.csv`
* Command: `console data:import:product-price-merchant-relationship`
