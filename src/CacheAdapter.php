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
     * @return Promise
     */
    public function get(string $key): Promise;

    /**
     * Has stored entry.
     *
     * @return Promise
     */
    public function has(string $key): Promise;

    /**
     * Remove entry.
     * If removed it will return true; otherwise false
     *
     * @return Promise
     */
    public function remove(string $key): Promise;

    /**
     * Save new cache entry.
     * If saved it will return true; otherwise false
     *
     * @param array|float|int|string|null $value
     *
     * @return Promise
     */
    public function save(string $key, $value, int $ttl = 0): Promise;

    /**
     * Clear storage.
     * Returns bool
     *
     * @return Promise
     */
    public function clear(): Promise;
}
