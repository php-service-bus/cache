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
     * @param string $key
     *
     * @return Promise<array|float|int|string|null>
     */
    public function get(string $key): Promise;

    /**
     * Has stored entry.
     *
     * @param string $key
     *
     * @return Promise<bool>
     */
    public function has(string $key): Promise;

    /**
     * Remove entry.
     *
     * @param string $key
     *
     * @return Promise<bool>
     */
    public function remove(string $key): Promise;

    /**
     * Save new cache entry.
     *
     * @param string                      $key
     * @param array|float|int|string|null $value
     * @param int                         $ttl
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
