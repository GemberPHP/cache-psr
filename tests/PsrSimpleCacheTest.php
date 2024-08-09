<?php

declare(strict_types=1);

namespace Gember\CachePsr\Test;

use Gember\CachePsr\PsrSimpleCache;
use Gember\CachePsr\Test\TestDoubles\TestPsrSimpleCache;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use DateInterval;

/**
 * @internal
 */
final class PsrSimpleCacheTest extends TestCase
{
    /** @var PsrSimpleCache<mixed> */
    private PsrSimpleCache $cache;
    private TestPsrSimpleCache $psrSimpleCache;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cache = new PsrSimpleCache(
            $this->psrSimpleCache = new TestPsrSimpleCache(),
        );
    }

    #[Test]
    public function itShouldSetAndGetFromCache(): void
    {
        $data = $this->cache->get('key');

        self::assertNull($data);
        self::assertFalse($this->cache->has('key'));

        $this->cache->set('key', 'some-data');

        $data = $this->cache->get('key');

        self::assertSame('some-data', $data);
        self::assertTrue($this->cache->has('key'));
        self::assertNull($this->psrSimpleCache->data['key'][1]);
    }

    #[Test]
    public function itShouldSetAndGetFromCacheWithTtl(): void
    {
        $this->cache->set('key', 'some-data', $ttl = new DateInterval('P2D'));

        $data = $this->cache->get('key');

        self::assertSame('some-data', $data);
        self::assertTrue($this->cache->has('key'));

        self::assertSame($ttl, $this->psrSimpleCache->data['key'][1]);
    }
}
