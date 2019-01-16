[![Build Status](https://travis-ci.org/mmasiukevich/cache.svg?branch=master)](https://travis-ci.org/mmasiukevich/cache)
[![Code Coverage](https://scrutinizer-ci.com/g/mmasiukevich/cache/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mmasiukevich/cache/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mmasiukevich/cache/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mmasiukevich/cache/?branch=master)
[![License](https://poser.pugx.org/mmasiukevich/cache/license)](https://packagist.org/packages/mmasiukevich/cache)

## What is it?

Cache component for [service-bus](https://github.com/mmasiukevich/service-bus) framework.
All adapters must implement the [CacheAdapter](https://github.com/mmasiukevich/cache/blob/master/src/CacheAdapter.php) interface.

Currently implemented:
* [InMemory](https://github.com/mmasiukevich/cache/blob/master/src/InMemory/InMemoryCacheAdapter.php): Simple in memory key\value storage