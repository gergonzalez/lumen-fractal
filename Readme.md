# Lumen Fractal wrapper package

This package provides an easy way to use [Fractal](http://fractal.thephpleague.com/) in Lumen.
[Fractal](http://fractal.thephpleague.com/) provides a presentation and transformation layer for complex data output, the like found in RESTful APIs.

## Getting Started

### Prerequisites

* Lumen < 5.4
* Lumen > 5.4 - Not tested yet

## Installation

Pull it via composer:

```bash
composer require gergonzalez/lumen-fractal
```

Once installed, register the service provider in **bootstrap/app.php**

```php
$app->register(Gergonzalez\Fractal\FractalServiceProvider::class);
```

## Usage


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.