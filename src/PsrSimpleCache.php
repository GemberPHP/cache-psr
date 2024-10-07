<?php

declare(strict_types=1);

namespace Gember\CachePsr;

use DateInterval;
use Gember\EventSourcing\Util\Cache\Cache;
use Psr\SimpleCache\CacheInterface;
use Override;

/**
 * @template T of mixed
 *
 * @implements Cache<T>
 */
final readonly class PsrSimpleCache implements Cache
{
    public function __construct(
        private CacheInterface $psrSimpleCache,
    ) {}

    #[Override]
    public function get(string $key): mixed
    {
        return $this->psrSimpleCache->get($key);
    }

    #[Override]
    public function has(string $key): bool
    {
        return $this->psrSimpleCache->has($key);
    }

    #[Override]
    public function set(string $key, mixed $data, ?DateInterval $timeToLive = null): void
    {
        $this->psrSimpleCache->set($key, $data, $timeToLive);
    }
}
