# Merchant Registration Feature Module
[![Latest Stable Version](https://poser.pugx.org/spryker-demo/merchant-registration-feature/v/stable.svg)](https://packagist.org/packages/spryker-demo/merchant-registration-feature)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg)](https://php.net/)

This feature handles merchant registration process.

###  Install the required modules using Composer

```
composer require spryker-demo/merchant-registration-feature
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

merchant.account.authorization.success,Registration Successful,en_US
merchant.account.authorization.success,Registrierung erfolgreich,de_DE
merchant.forms.accept_terms,Accept Terms,en_US
merchant.forms.accept_terms,AGB akzeptieren,de_DE
merchant.register-page.title,Registrieren und loslegen auf den Spryker Marktplatz,de_DE
merchant.register-page.title,Register and get started on the Spryker Marketplace,en_US
merchant.register-page.company-title,Registrierung des Unternehmens,de_DE
merchant.register-page.company-title,Company Registration,en_US
merchant.register-page.company-text,"Geben Sie Ihre Unternehmensdaten ein, um den Registrierungsprozess zu starten.",de_DE
merchant.register-page.company-text,"Fill in your company details to initiate your registration process.",en_US
merchant.register.registration_number,Registrierungsnummer,de_DE
merchant.register.registration_number,"Registration number",en_US
merchant.register-page.account-title,Konto erstellen,de_DE
merchant.register-page.account-title,Account Creation,en_US
merchant.register-page.account-text,"Fügen Sie die Details Ihres ersten Benutzerkontos hinzu.",de_DE
merchant.register-page.account-text,"Add the details of your first user account.",en_US
merchant.register.title,Titel der Kontaktperson,de_DE
merchant.register.title,Contact person title,en_US
merchant.register.banner-title,Werden Sie ein Spryker Händler,de_DE
merchant.register.banner-title,Become a Spryker Merchant,en_US
merchant.register.banner-button,Jetzt Registrieren,de_DE
merchant.register.banner-button,Register now,en_US
merchant.register.banner-link,/de/merchant/register,de_DE
merchant.register.banner-link,/en/merchant/register,en_US
merchant.register.step,Schritt,de_DE
merchant.register.step,Step,en_US
merchant.register.step.title-1,Registrierung,de_DE
merchant.register.step.title-1,Registration,en_US
merchant.register.step.title-2,Vertrag,de_DE
merchant.register.step.title-2,Contract,en_US
merchant.register.step.title-3,Onboarding,de_DE
merchant.register.step.title-3,Onboarding,en_US
merchant.register.step.title-4,Start beantragen,de_DE
merchant.register.step.title-4,Request Launch,en_US
merchant.register.step.text-1,"Registrieren Sie sich als neuer Händler und unterzeichnen Sie die Spryker Händlervereinbarung und vervollständigen Sie Ihr Profil im Händlerportal.",de_DE
merchant.register.step.text-1,"Register as a new merchant and sign the Spryker Merchant Agreement and complete your profile in the Merchant Portal.",en_US
merchant.register.step.text-2,"Nach der Genehmigung erwarten Sie eine Einladung zur Einrichtung Ihres Marketplace-Händlerkontos.",de_DE
merchant.register.step.text-2,"Once approved, expect an invitation to set up your Marketplace merchant account.",en_US
merchant.register.step.text-3,"Wählen Sie eine Integrationsmethode, fügen Sie Ihre Artikel hinzu und testen Sie Bestellungen.",de_DE
merchant.register.step.text-3,"Choose an integration method, add your items, and test orders.",en_US
merchant.register.step.text-4,"Wenn Sie bereit sind, beantragen Sie die Markteinführung, und wir führen eine abschließende Prüfung durch, damit Sie verkaufen können.",de_DE
merchant.register.step.text-4,"When you’re ready, request to launch and we’ll do a final review to get you selling.",en_US
```

### Import translations

```
console data:import:glossary
```
