<?php

namespace FoundryCo\DualEntry\Laravel;

use FoundryCo\DualEntry\DualEntryClient;
use Illuminate\Support\ServiceProvider;

/**
 * Opt-in Laravel integration, registered via package auto-discovery when
 * `illuminate/support` is installed.
 */
final class DualEntryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/dualentry.php', 'dualentry');

        $this->app->singleton(DualEntryClient::class, static function ($app): DualEntryClient {
            $config = $app['config']->get('dualentry', []);

            return DualEntryClient::make($config['api_key'] ?? '', [
                'base_uri' => $config['base_uri'] ?? null,
                'timeout' => $config['timeout'] ?? 30.0,
                'max_retries' => $config['max_retries'] ?? 2,
                'auto_idempotency_keys' => $config['auto_idempotency_keys'] ?? true,
                'guzzle' => $config['guzzle'] ?? [],
            ]);
        });

        $this->app->alias(DualEntryClient::class, 'dualentry');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/dualentry.php' => $this->app->configPath('dualentry.php'),
            ], 'dualentry-config');
        }
    }

    public function provides(): array
    {
        return [DualEntryClient::class, 'dualentry'];
    }
}
