<?php

namespace FoundryCo\DualEntry\Laravel\Facades;

use FoundryCo\DualEntry\DualEntryClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \FoundryCo\DualEntry\Resources\InvoiceResource invoices()
 * @method static \FoundryCo\DualEntry\Resources\BillResource bills()
 * @method static \FoundryCo\DualEntry\Resources\CustomerResource customers()
 * @method static \FoundryCo\DualEntry\Resources\VendorResource vendors()
 * @method static \FoundryCo\DualEntry\Resources\JournalEntryResource journalEntries()
 * @method static \FoundryCo\DualEntry\Transport\Transport getTransport()
 * @method static \FoundryCo\DualEntry\Support\RateLimitInfo|null getLastRateLimit()
 *
 * Every other resource accessor on {@see DualEntryClient} (accounts(),
 * webhooks(), paperChecks(), taxes(), ...) is available the same way; the
 * full list lives on that class.
 *
 * @see DualEntryClient
 */
final class DualEntry extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return DualEntryClient::class;
    }
}
