# Spryker Demo Product Subscription Feature

## Installation

### Add repositories to composer as they are not registered in packagist.org

```
composer config repositories.spryker-demo-product-subscription-feature path './demo-vendor/product-subscription-feature'
composer config repositories.spryker-demo-oms-subscription path './demo-vendor/oms-subscription'
composer config repositories.spryker-demo-customer-subscription-page path './demo-vendor/customer-subscription-page'
```

### Install feature

```
composer require spryker-demo/product-subscription-feature
```

### Add `SprykerDemo` namespace to configuration

```
$config[KernelConstants::CORE_NAMESPACES] = [
    ...
    'SprykerDemo',
];
```

### Wire the plugins

```
# src/Pyz/Yves/Router/RouterDependencyProvider.php

use SprykerDemo\Yves\CustomerSubscriptionPage\Plugin\Router\CustomerSubscriptionPageRouteProviderPlugin;
...

protected function getRouteProvider(): array
{
    return [
        ...
        new CustomerSubscriptionPageRouteProviderPlugin(),
    ];
}
```

### Adjust OMS configuration file

```
cp vendor/spryker-demo/oms-subscription/config/Zed/oms/SubscriptionSubprocess/DummySubscription01.xml config/Zed/oms/SubscriptionSubprocess/DummySubscription01.xml

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

customer.cancel_subscription.success_message,Das Abonnement für Produkt %product% wurde erfolgreich gekündigt,de_DE
customer.cancel_subscription.success_message,Subscription for product %product% has been successfully canceled,en_US
customer.cancel_subscription.error_message,Das Abonnement für diesen Bestellartikel kann nicht gekündigt werden!,de_DE
customer.cancel_subscription.error_message,Can't cancel subscription for this order item!,en_US
customer.cancel_subscription.warning_message,Abonnement bereits gekündigt!,de_DE
customer.cancel_subscription.warning_message,Subscription already cancelled!,en_US
oms.state.subscription-active,Abonnement aktiv,de_DE
oms.state.subscription-active,Subscription Active,en_US
oms.state.subscription-cancelled,Abonnement gekündigt,de_DE
oms.state.subscription-cancelled,Subscription Cancelled,en_US
customer.account.subscriptions,Abonnements,de_DE
customer.account.subscriptions,Subscriptions,en_US
customer.subscription.subscription_id,Referenz,de_DE
customer.subscription.subscription_id,Reference,en_US
customer.subscription.interval,Intervall,de_DE
customer.subscription.interval,Interval,en_US
customer.subscription.item_state,Stand,de_DE
customer.subscription.item_state,State,en_US
customer.subscription.item_name,Artikelname,de_DE
customer.subscription.item_name,Name,en_US
customer.account.no_subscriptions,Derzeit keine Abonnements,de_DE
customer.account.no_subscriptions,No subscriptions at the moment,en_US
```

### Apply Twig customization

```
# src/Pyz/Yves/ShopUi/Theme/default/components/molecules/user-navigation/user-navigation.twig

{% include molecule('navigation-list') with {
            modifiers: ['secondary'],
            class: config.name ~ '__sub-nav',
            data: {
                nodes: [
                // ...
                {
                    url: url('customer/subscription'),
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
            url: path('customer/subscription'),
            label: 'customer.account.subscriptions' | trans,
            icon: 'subscribe',
        },

        // ...
    ]
} %}
```
