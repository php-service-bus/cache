<?php

/**
 * Cache implementation.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Cache\InMemory;

use Amp\Promise;
use Amp\Success;
use ServiceBus\Cache\CacheAdapter;

/**
 *
 */
final class InMemoryCacheAdapter implements CacheAdapter
{
    private InMemoryStorage $storage;

    /**
     * @psalm-suppress MixedTypeCoercion
     *
     * {@inheritdoc}
     */
    public function get(string $key): Promise
    {
        return new Success($this->storage->get($key));
    }

    /**
     * @psalm-suppress MixedTypeCoercion
     *
     * {@inheritdoc}
     */
    public function has(string $key): Promise
    {
        return new Success($this->storage->has($key));
    }

    /**
     * @psalm-suppress MixedTypeCoercion
     *
     * {@inheritdoc}
     */
    public function remove(string $key): Promise
    {
        $this->storage->remove($key);

        return new Success(true);
    }

    /**
     * @psalm-suppress MixedTypeCoercion
     *
     * {@inheritdoc}
     */
    public function save(string $key, $value, int $ttl = 0): Promise
    {
        /** @psalm-suppress MixedArgument */
        $this->storage->push($key, $value, $ttl);

        return new Success(true);
    }

    /**
     * {@inheritdoc}
     */
    public function clear(): Promise
    {
        $this->storage->clear();

        return new Success();
    }

    public function __construct()
    {
        $this->storage = InMemoryStorage::instance();
    }
}
