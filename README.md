# 🫚 Gember Cache: PSR SimpleCache (PSR-16)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE)
[![PHP Version](https://img.shields.io/badge/php-%5E8.3-8892BF.svg?style=flat)](http://www.php.net)

[Gember Event Sourcing](https://github.com/GemberPHP/event-sourcing) Cache adapter based on [psr/simple-cache](https://github.com/php-fig/simple-cache) (PSR-16).

> All external dependencies in Gember Event Sourcing are organized into separate packages,
> making it easy to swap out a vendor adapter for another.

## Installation
Install with Composer:
```bash
composer require gember/cache-psr
```

## Configuration
Bind this adapter to the `Cache` interface in your service definitions.

### Examples

#### Vanilla PHP
```php
use Gember\CachePsr\PsrSimpleCache;

$cache = new PsrSimpleCache(
    new SomeSimpleCacheAdapter(), // An implementation of Psr\SimpleCache\CacheInterface of your choice 
);
```
You will need to install a PSR-16 Cache implementation as well. Some available packages:
- [symfony/cache](https://github.com/symfony/cache)
- [laminas/laminas-cache](https://github.com/laminas/laminas-cache)
- [phpfastcache/phpfastcache](https://github.com/PHPSocialNetwork/phpfastcache)

#### Symfony
It is recommended to use the [Symfony bundle](https://github.com/GemberPHP/event-sourcing-symfony-bundle) to configure Gember Event Sourcing.
With this bundle, the adapter is automatically set as the default for Cache.

If you're not using the bundle, you can bind it directly to the `Cache` interface.

```yaml
Gember\EventSourcing\Util\Cache\Cache:
  class: Gember\CachePsr\PsrSimpleCache\PsrSimpleCache
  arguments:
    - '@cache.app' # or any other Symfony Cache definition of your choice
```
