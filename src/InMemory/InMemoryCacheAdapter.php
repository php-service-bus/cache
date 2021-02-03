<?php

/**
 * Cache implementation.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\Cache\InMemory;

use Amp\Promise;
use Amp\Success;
use ServiceBus\Cache\CacheAdapter;
use function Amp\call;

/**
 *
 */
final class InMemoryCacheAdapter implements CacheAdapter
{
    /** @var InMemoryStorage */
    private $storage;

    public function get(string $key): Promise
    {
        return new Success($this->storage->get($key));
    }

    public function has(string $key): Promise
    {
        return new Success($this->storage->has($key));
    }

    public function remove(string $key): Promise
    {
        $this->storage->remove($key);

        return new Success(true);
    }

    public function save(string $key, $value, int $ttl = 0): Promise
    {
        $this->storage->push($key, $value, $ttl);

        return new Success(true);
    }

    public function clear(): Promise
    {
        return call(
            function (): void
            {
                $this->storage->clear();
            }
        );
    }

    public function __construct()
    {
        $this->storage = InMemoryStorage::instance();
    }
}
