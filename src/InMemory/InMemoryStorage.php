<?php

/**
 * Cache implementation.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\Cache\InMemory;

/**
 * In memory data storage.
 *
 * @internal
 */
final class InMemoryStorage
{
    /**
     * @var self|null
     */
    private static $instance;

    /**
     * @psalm-var array<string, int|string|float|null|array>
     */
    private $storage = [];

    /**
     * @psalm-var array<string, int>
     */
    private $expires = [];

    public static function instance(): self
    {
        if (self::$instance === null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Reset instance.
     */
    public function reset(): void
    {
        self::$instance = null;
    }

    /**
     * Remove stored entries.
     */
    public function clear(): void
    {
        $this->storage = [];
        $this->expires = [];
    }

    /**
     * Has stored entry.
     */
    public function has(string $key): bool
    {
        return isset($this->expires[$key]);
    }

    /**
     * Receive stored value.
     */
    public function get(string $key): array|float|int|string|null
    {
        if (isset($this->expires[$key]))
        {
            $expired = !($this->expires[$key] === -1) && \time() > $this->expires[$key];

            if ($expired)
            {
                $this->remove($key);

                return null;
            }

            return $this->storage[$key];
        }

        return null;
    }

    /**
     * Remove stored value.
     */
    public function remove(string $key): void
    {
        unset($this->storage[$key], $this->expires[$key]);
    }

    /**
     * Store specified value.
     */
    public function push(string $key, array|float|int|string|null $value, int $ttl = 0): void
    {
        $this->storage[$key] = $value;
        $this->expires[$key] = 0 < $ttl ? \time() + $ttl : -1;
    }

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    private function __clone()
    {
    }
}
