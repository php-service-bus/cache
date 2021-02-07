<?php /** @noinspection PhpUnhandledExceptionInspection */

/**
 * Cache implementation.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Cache\Tests\InMemory;

use function Amp\Promise\wait;
use PHPUnit\Framework\TestCase;
use ServiceBus\Cache\InMemory\InMemoryCacheAdapter;
use ServiceBus\Cache\InMemory\InMemoryStorage;

/**
 *
 */
final class InMemoryCacheAdapterTest extends TestCase
{
    /**
     * @var InMemoryCacheAdapter
     */
    private $adapter;

    protected function setUp(): void
    {
        parent::setUp();

        InMemoryStorage::instance()->reset();

        $this->adapter = new InMemoryCacheAdapter();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        InMemoryStorage::instance()->reset();

        unset($this->adapter);
    }

    /**
     * @test
     */
    public function getUnknownEntry(): void
    {
        self::assertNull(wait($this->adapter->get('qwerty')));
    }

    /**
     * @test
     */
    public function hasUnknownEntry(): void
    {
        self::assertFalse(wait($this->adapter->has('qwerty')));
    }

    /**
     * @test
     */
    public function removeUnknownEntry(): void
    {
        wait($this->adapter->remove('qwerty'));
    }

    /**
     * @test
     */
    public function clear(): void
    {
        wait($this->adapter->save('qwerty', 'root', 50));
        self::assertTrue(wait($this->adapter->has('qwerty')));

        wait($this->adapter->clear());
        self::assertFalse(wait($this->adapter->has('qwerty')));
    }

    /**
     * @test
     */
    public function getExpired(): void
    {
        wait($this->adapter->save('qwerty', 'root', 1));
        \sleep(2);

        self::assertNull(wait($this->adapter->get('qwerty')));
    }

    /**
     * @test
     */
    public function getExists(): void
    {
        wait($this->adapter->save('qwerty', 'root', 50));

        self::assertSame('root', wait($this->adapter->get('qwerty')));
    }

    /**
     * @test
     */
    public function hasExists(): void
    {
        wait($this->adapter->save('qwerty', 'root', 50));

        self::assertTrue(wait($this->adapter->has('qwerty')));
    }

    /**
     * @test
     */
    public function removeExists(): void
    {
        wait($this->adapter->save('qwerty', 'root', 50));
        self::assertTrue(wait($this->adapter->has('qwerty')));

        wait($this->adapter->remove('qwerty'));
        self::assertFalse(wait($this->adapter->has('qwerty')));
    }
}
