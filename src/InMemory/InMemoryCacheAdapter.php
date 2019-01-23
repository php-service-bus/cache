<?php

/**
 * PHP Service Bus simple cache implementation
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Infrastructure\Cache\InMemory;

use Amp\Promise;
use Amp\Success;
use ServiceBus\Infrastructure\Cache\CacheAdapter;

/**
 *
 */
final class InMemoryCacheAdapter implements CacheAdapter
{
    /**
     * @var InMemoryStorage
     */
    private $storage;

    /**
     * @inheritDoc
     */
    public function get(string $key): Promise
    {
        return new Success($this->storage->get($key));
    }

    /**
     * @inheritDoc
     */
    public function has(string $key): Promise
    {
        return new Success($this->storage->has($key));
    }

    /**
     * @inheritDoc
     */
    public function remove(string $key): Promise
    {
        $this->storage->remove($key);

        return new Success(true);
    }

    /**
     * @inheritDoc
     */
    public function save(string $key, $value, int $ttl = 0): Promise
    {
        /** @psalm-suppress MixedArgument */
        $this->storage->push($key, $value, $ttl);

        return new Success(true);
    }

    /**
     * @inheritDoc
     */
    public function clear(): Promise
    {
        $this->storage->clear();

        return new Success(true);
    }

    public function __construct()
    {
        $this->storage = InMemoryStorage::instance();
    }
}
