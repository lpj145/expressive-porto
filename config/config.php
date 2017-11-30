<?php

use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

// To enable or disable caching, set the `ConfigAggregator::ENABLE_CACHE` boolean in
// `config/autoload/local.php`.
$cacheConfig = [
    'config_cache_path' => 'data/config-cache.php',
];

$aggregator = new ConfigAggregator([
    \ExpressiveRedis\ConfigProvider::class,
    \ExpressiveLaravelValidation\ConfigProvider::class,
    AuthExpressive\ConfigProvider::class,
    \App\Containers\Authentication\Providers\MainProvider::class,
    \App\Ship\Provides\ShipProvider::class,
    \App\Ship\Provides\ShipCommandsProvider::class,
    \App\Containers\Consumers\Providers\ConsumersProvider::class,
    // Include cache configuration
    new ArrayProvider($cacheConfig),
    // Load application config in a pre-defined order in such a way that local settings
    // overwrite global settings. (Loaded as first to last):
    //   - `global.php`
    //   - `*.global.php`
    //   - `local.php`
    //   - `*.local.php`
    new PhpFileProvider('config/autoload/{{,*.}global,{,*.}local}.php'),

    // Load development config if it exists
    new PhpFileProvider('config/development.config.php'),
], $cacheConfig['config_cache_path']);

return $aggregator->getMergedConfig();
