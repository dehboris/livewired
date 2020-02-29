# Livewired

[![Latest Version](https://badgen.net/packagist/v/kodekeep/livewired)](https://packagist.org/packages/kodekeep/livewired)
[![Software License](https://badgen.net/packagist/license/kodekeep/livewired)](https://packagist.org/packages/kodekeep/livewired)
[![Build Status](https://img.shields.io/github/workflow/status/kodekeep/livewired/run-tests?label=tests)](https://github.com/kodekeep/livewired/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Coverage Status](https://badgen.net/codeclimate/coverage/kodekeep/livewired)](https://codeclimate.com/github/kodekeep/livewired)
[![Quality Score](https://badgen.net/codeclimate/maintainability/kodekeep/livewired)](https://codeclimate.com/github/kodekeep/livewired)
[![Total Downloads](https://badgen.net/packagist/dt/kodekeep/livewired)](https://packagist.org/packages/kodekeep/livewired)

This package was created by, and is maintained by [Brian Faust](https://github.com/faustbrian), and provides reusable Laravel Livewire components.

## Architectural Decisions

All components in this package have been extracted from real-world production applications and have been designed to be as flexible as possible to achieve maximum reusability. Each component is broken down into multiple methods that can be overwritten each on their own to overwrite specific parts without having to overwrite or reimplement everything.

That being said there will still be times where you will be better off to reimplement a component on your own as all of these components are extracted from real-world production applications which means major changes to their behavior are unlikely to be merged into this package.

### `before*`

This method is called before the main functionality of a component is invoked. This should be the place where you perform anything that you want to be executed before the actual implementation is executed. **This will generally be `before{ComponentName}`.**

### `{componentName}`

**Each component has a method that is named the same as the component.** This method is the bread and butter of each component. It contains the actual logic that is being executed when all authorization checks pass. You generally shouldn't face scenarios where you need to overwrite it but if you do you should make sure that you don't deviate too much from the original implementation as breaking changes to the component in other places could have unwanted side effects on your application.

### `after*`

This method is called before the main functionality of a component is invoked. This should be the place where you perform anything that you want to be executed after the actual implementation is executed. **This will generally be `after{ComponentName}`.**

### Exceptions

Note that there might be components that diverge from this structure due to limitations with how Livewire components work. An example of this would be a case where we want to split behaviors without having to use events for communication which means we could use [nested components](https://laravel-livewire.com/docs/nesting-components/) but due to them not being reactive we would end up with inconsistent and wrong results.

### Views

This package comes with empty views as a default. If you need to quickly get some markup for the components your best bet is to grab a license of [Tailwind UI](https://tailwindui.com/components) and use one of their many components to save you time.

## Installation

```bash
composer require kodekeep/livewired
```

## Usage

``` php
$skeleton = new KodeKeep\Skeleton();
echo $skeleton->echoPhrase('Hello, KodeKeep!');
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@kodekeep.com. All security vulnerabilities will be promptly addressed.

## Credits

This project exists thanks to all the people who [contribute](../../contributors).

## Support Us

We invest a lot of resources into creating and maintaining our packages. You can support us and the development through [GitHub Sponsors](https://github.com/sponsors/faustbrian).

## License

Livewired is an open-sourced software licensed under the [MPL-2.0](LICENSE.md).
