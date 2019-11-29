<?php

/**
 * Cache implementation.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Cache;

use Amp\Promise;

/**
 * Cache adapter.
 */
interface CacheAdapter
{
    /**
     * Receive stored entry.
     *
     * @psalm-suppress MixedTypeCoercion
     *
     * @return Promise<array|float|int|string|null>
     */
    public function get(string $key): Promise;

    /**
     * Has stored entry.
     *
     * @return Promise<bool>
     */
    public function has(string $key): Promise;

    /**
     * Remove entry.
     *
     * @return Promise<bool>
     */
    public function remove(string $key): Promise;

    /**
     * Save new cache entry.
     *
     * @param array|float|int|string|null $value
     *
     * @return Promise<bool>
     */
    public function save(string $key, $value, int $ttl = 0): Promise;

    /**
     * Clear storage.
     *
     * @return Promise<bool>
     */
    public function clear(): Promise;
}
