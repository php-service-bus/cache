<?php

/**
 * Cache implementation.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

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
     * If removed it will return true; otherwise false
     *
     * @return Promise<bool>
     */
    public function remove(string $key): Promise;

    /**
     * Save new cache entry.
     * If saved it will return true; otherwise false
     *
     * @param array|float|int|string|null $value
     *
     * @return Promise<bool>
     */
    public function save(string $key, $value, int $ttl = 0): Promise;

    /**
     * Clear storage.
     *
     * @return Promise<void>
     */
    public function clear(): Promise;
}
