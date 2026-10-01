# foundry-co/dualentry

A standalone PHP client for the [DualEntry](https://dualentry.com) public
API, built on [Guzzle](https://docs.guzzlephp.org/). Framework-agnostic by
default, with an opt-in Laravel service provider and facade.

Covers every resource documented at
[docs.dualentry.com/developers/guides/api](https://docs.dualentry.com/developers/guides/api):
invoices, bills, customers, vendors, journal entries, quotes, sales and
purchase orders, payments, credits, refunds, prepayments, recurring
transactions, fixed assets, contracts, bank feeds and reconciliation,
webhooks, approval workflows, tax calculation, data exports, and more.

## Requirements

- PHP 8.1+
- An organization API key from DualEntry's **API Keys** settings page

## Installation

```bash
composer require foundry-co/dualentry
```

## Quickstart

Every resource works with one real, immutable class per record type — the
same class for reading and writing, not separate payload/response pairs.

```php
use FoundryCo\DualEntry\DualEntryClient;
use FoundryCo\DualEntry\Resources\Data\Invoice;
use FoundryCo\DualEntry\Resources\Data\InvoiceLineItem;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

$dualEntry = DualEntryClient::make($_ENV['DUALENTRY_API_KEY']);

// List the first page of open invoices — returns Invoice[]
$invoices = $dualEntry->invoices()->list([
    'payment_status' => ['open'],
    'limit' => 50,
]);

// Fetch a single record — returns Invoice
$invoice = $dualEntry->invoices()->find(10042);
$invoice->amountDue;         // string (decimal-precision fields stay strings)
$invoice->recordStatus;      // RecordStatus::Posted
$invoice->items[0]->itemId;  // typed line items
$invoice->exists;             // true — this one came off the wire

// Create a record via the named constructor (the real constructor is
// private — Invoice::make() is the only way to build one yourself). A
// UUIDv4 Idempotency-Key is attached to the request automatically.
$created = $dualEntry->invoices()->create(Invoice::make(
    companyId: 1,
    customerId: 55,
    date: '2026-01-15',
    dueDate: '2026-02-14',
    currencyIso4217Code: SystemCurrencies::Usd,
    items: [
        new InvoiceLineItem(position: 1, itemId: 10, memo: 'Consulting', quantity: '2', rate: '150.00'),
    ],
));
$created->exists; // true — this one is now a real, created record

// Partial update (PATCH) — a plain array, wire-format keys, no object needed:
$dualEntry->invoices()->update(10042, ['memo' => 'Updated memo']);

// Full replace (PUT) — takes the same Invoice type, typically one you just
// fetched and tweaked immutably with with()/withX(): every field rides
// along unchanged except the one(s) you touched, since PUT doesn't merge —
// anything you omit gets reset, so send the full record, not a sparse one.
$dualEntry->invoices()->replace(10042, $invoice->withMemo('Updated memo'));

// Email it — bespoke actions like this stay array-based (no dedicated DTO)
$dualEntry->invoices()->send(10042, ['to' => ['ap@customer.com']]);

$dualEntry->invoices()->delete(10042);
```

Every resource accessor returns a typed resource object off
`FoundryCo\DualEntry\Resources\*`, working with one record/line-item class
per resource off `FoundryCo\DualEntry\Resources\Data\*` and shared value
objects/enums off `FoundryCo\DualEntry\ValueObjects\*`. See
[Resources](#resources) below for the full list,
[Typed records](#typed-records) for how these are shaped, and
[Configuration](#configuration) for every option accepted by
`DualEntryClient::make()`.

## Configuration

```php
$dualEntry = DualEntryClient::make($apiKey, [
    // Switch to the development environment, or point at a custom base URL.
    'base_uri' => 'https://api-dev.dualentry.com',

    'timeout' => 30.0,

    // Automatic retries (honoring any Retry-After header) for 429s and 5xxs.
    'max_retries' => 2,

    // Auto-generate a UUIDv4 Idempotency-Key for write requests that don't
    // supply their own. Disable if you want to manage keys yourself.
    'auto_idempotency_keys' => true,

    // Merged into the underlying Guzzle client: proxy, verify, a custom
    // handler for testing, etc.
    'guzzle' => [],
]);
```

For full control — dependency injection, a shared Guzzle client, a mock
handler in tests — construct the transport yourself and hand it to the
client:

```php
use FoundryCo\DualEntry\DualEntryClient;
use FoundryCo\DualEntry\Transport\GuzzleTransport;

$transport = GuzzleTransport::make(apiKey: $apiKey);
$dualEntry = new DualEntryClient($transport);
```

`DualEntryClient` and every resource depend only on the
`FoundryCo\DualEntry\Transport\Transport` interface, so you can swap in your
own implementation (or a test double) without touching Guzzle at all.

## Resources

Each method below is a resource accessor on `DualEntryClient`, returning an
object with (at minimum) `list()`, `find()`, `create()`, `replace()`
(PUT), `update()` (PATCH), and `delete()` — whichever of those the
underlying endpoint actually supports; only the methods a given resource
actually has are declared, so unsupported operations are a compile-time/IDE
error rather than a surprise 404 at runtime. Transactional records that
expose line items or attachments in the API also get `lines()` and
`uploadAttachments()`. See [Typed records](#typed-records) for the record
class these methods take and return, and why `update()` takes a plain array
while `create()`/`replace()` take the record type.

| Accessor | Notes |
|---|---|
| `accounts()` | Chart of accounts |
| `accountBalances()` | Read-only |
| `bankConnections()` | `listAccounts()`, `registerAccount()`, `ingestTransactions()` |
| `bankMatch()` | Bespoke: `suggestions()`, `populateSuggestions()`, `match()`, `unmatch()`, `bankTransactions()`, `statusCounts()` |
| `bankTransfers()` | |
| `bills()` | |
| `budgets()` | Read-only |
| `cashSales()` | |
| `classifications()` / `classificationLines()` | |
| `companies()` | Read-only |
| `contracts()` | `listChangeOrders()`, `createChangeOrder()`, `usage()`, `bulkUpsertUsage()` |
| `customFields()` | |
| `customers()` | |
| `customerCredits()`, `customerDeposits()`, `customerPayments()`, `customerPrepayments()`, `customerPrepaymentApplications()`, `customerRefunds()` | |
| `depreciationBooks()` | Read-only |
| `directExpenses()` | |
| `exchangeRates()` | Read-only |
| `exportJobs()` | Async bulk data exports |
| `fixedAssetClasses()` | Read-only |
| `fixedAssets()` | `schedule()` for depreciation schedules |
| `gstTaxRates()`, `vatRates()`, `productTaxCodes()` | |
| `health()` | `check()` |
| `inbox()` | Read-only: `records()`, `transactions()` |
| `intercompanyJournalEntries()` | |
| `invoices()` | `send()`, `replaceAttachments()` |
| `items()` | |
| `journalEntries()` | |
| `oauth()` | `authorize()`, `token()`, `callback()` |
| `paperChecks()` | `printNow()`, `printLater()`, `printBatch()` |
| `purchaseOrders()`, `salesOrders()`, `quotes()` | `quotes()->send()` |
| `recurringBills()`, `recurringInvoices()`, `recurringJournalEntries()` | |
| `statisticalJournals()` | |
| `taxes()` | `calculate()` |
| `vendors()` | |
| `vendorCredits()`, `vendorPayments()`, `vendorPrepayments()`, `vendorPrepaymentApplications()`, `vendorRefunds()` | |
| `webhooks()` | `topics()`, `deliveries()` |
| `workflows()` | Read-only approval policies: `versions()`, `executionStates()`, `roles()` |

## Typed records

Every resource's request/response shape is modeled from DualEntry's own
OpenAPI spec as **one** `readonly` PHP class under
`FoundryCo\DualEntry\Resources\Data\*` — the same class for reading and
writing, not a separate payload/response pair per resource:

- **Fields required to create one** are required constructor params.
  Everything else — fields optional on create, *and* server-computed ones
  (totals, resolved names, approval/lifecycle state, audit timestamps) —
  is optional and nullable.
- The constructor is **private**. `{Name}::make(...)` is the only public
  way to build a fresh instance yourself (for `create()`); it's a plain
  named constructor over the writable fields, nothing more.
- **`{Name}::fromWire(array $data): self`** hydrates a full API response,
  including the server-only fields `make()` doesn't expose.
- **`{Name}->toWire(): array`** serializes only the fields DualEntry's
  create/replace schema actually accepts, dropping nulls — hand it a record
  you got from `find()` and the server-only fields it carries are silently
  left out, no manual stripping needed.
- **`{Name}->exists`** is `true` on anything that came from `fromWire()`
  (so: every `find()`/`list()` result, and the return value of
  `create()`/`replace()`/`update()`) and `false` on a fresh `::make(...)` —
  mirroring Eloquent's `$model->exists`. It's set exactly once, by
  `fromWire()`, and the private constructor means you can't pass `exists:
  true` yourself without reflecting past the constructor's visibility —
  going out of your way, not a one-line accident.
- Every record and line-item class is immutable and PSR-7-flavored:
  **`with(array $attributes)`** returns a new instance with just those
  fields changed, and **`withX()`** (e.g. `withMemo(...)`) does the same
  for one field — both come from a shared `ImmutableAttributes` trait via
  reflection and `__call`, not generated per-class, so there's no
  per-property method bloat. `exists` rides along unchanged through either.
- **`{Name}LineItem`** — a transactional record's `items`, where it has
  them. Simpler than the top-level record: no `exists` concept (line items
  don't have an independent create/replace lifecycle of their own), so the
  constructor is just public.

```php
$invoice = $dualEntry->invoices()->find(10042);
$invoice->exists; // true

$draft = Invoice::make(companyId: 1, customerId: 55, date: '2026-01-15', /* ... */);
$draft->exists; // false
```

A handful of shapes are shared across resources rather than modeled per
resource, under `FoundryCo\DualEntry\ValueObjects\*`: `Address`,
`Attachment`, `TaxMetadata`, `TaxRegistrationNumbers`,
`RecordClassification`, `ItemTax` — these use the same `fromWire()`/
`toWire()`/`with()`/`withX()` shape, just with a plain public constructor
(no `exists` concept applies to a nested value object). Enums
(`RecordStatus`, `SystemCurrencies`, `SystemCountries`,
`PurchaseOrderLifecycleStatus`, ...) live under
`FoundryCo\DualEntry\ValueObjects\Enums\*`; every enum's backed value is
upper-cased for a consistent style (`RecordStatus::Posted->value ===
'POSTED'`), with `fromWire()`/`toWire()` mapping explicitly to and from the
real (often lower-case) string DualEntry sends and expects on the wire —
you won't normally need these directly, since record hydration/
serialization calls them for you.

One fix worth calling out: DualEntry's own OpenAPI spec defines
`SystemCountries` (used by `Address.country` and a few list filters) as
every two-letter combination from `AA` to `ZZ` — 676 placeholder values,
not real country codes (confirmed against the spec's own description text
elsewhere: *"ISO-2 country code ... (IN, AU, NZ, SG, CA)"*). We generate
the real ISO 3166-1 alpha-2 list ourselves instead of trusting that enum.

Nested shapes that are resource-specific, rarely touched, and not worth a
dedicated class (e.g. a purchase order's `next_approvers`, a contract's
cached metrics) stay as plain `array` properties rather than being modeled.

Bespoke, non-CRUD actions (`invoices()->send()`, `paperChecks()->printNow()`,
`taxes()->calculate()`, the `bankMatch()`/`workflows()`/`inbox()` methods,
etc.) still take/return plain arrays — they aren't part of the generic
create/replace/update/find pattern the Data classes are generated from.

## Pagination

List endpoints use limit/offset pagination and return `{"items": [...],
"count": N}` — the client unwraps `items` for you, and treats a page
shorter than the requested limit as the end of the data. Fetch pages
yourself:

```php
$page = $dualEntry->invoices()->list(['limit' => 100, 'offset' => 100]);
```

Or let a `Paginator` walk every page for you, lazily:

```php
foreach ($dualEntry->invoices()->paginate(['payment_status' => ['open']]) as $invoice) {
    // one invoice at a time, across as many pages as it takes
}
```

`paginate()` accepts the same filters as `list()`. It's a `Generator`
under the hood, so nothing is fetched until you iterate.

## Error handling

Every non-2xx response raises a typed exception under
`FoundryCo\DualEntry\Exceptions`, all extending `ApiException` (itself a
`DualEntryException`):

| Exception | Status | |
|---|---|---|
| `AuthenticationException` | 401, 403 | Missing/unknown/revoked key, or a valid key missing a required role |
| `ValidationException` | 400, 402, 422 | Malformed request, field validation errors, or an idempotency replay with a mismatched body |
| `NotFoundException` | 404 | |
| `ConflictException` | 409 | An idempotency key is already in flight, or can't be replayed |
| `RateLimitException` | 429 | Carries `getRetryAfterSeconds()` and `getRateLimit()` |
| `ServerException` | 5xx | |
| `TransportException` | — | Network-level failure; never reached DualEntry |

```php
use FoundryCo\DualEntry\Exceptions\ValidationException;

try {
    $dualEntry->invoices()->create($payload);
} catch (ValidationException $e) {
    $e->getErrors();                       // ['customer_id' => ['This field is required.'], ...]
    $e->getFieldErrors('customer_id');     // ['This field is required.']
    $e->getGeneralErrors();                // the "__all__" bucket
    $e->getErrorCode();                    // e.g. 'period_locked'
    $e->getStatusCode();
}
```

429s and 5xxs are retried automatically (`max_retries`, default 2),
honoring any `Retry-After` header before falling back to exponential
backoff. Inspect the rate limit state from the most recent response at any
time:

```php
$rateLimit = $dualEntry->getLastRateLimit();
$rateLimit?->limit;     // burst capacity of the binding bucket
$rateLimit?->remaining;
$rateLimit?->resetAt;   // unix timestamp
```

## Idempotency

Every write request (`create`, `replace`, `update`, `delete`, and the
various action methods like `send()`) is sent with an `Idempotency-Key`
header by default — a fresh UUIDv4 per call, reused automatically if Guzzle
retries the request at the transport level. DualEntry replays the original
response for 48 hours if you resend the same key with the same body, and
returns a 422 if the body differs or a 409 if a request with that key is
still in flight.

Supply your own key (e.g. to make your own retry logic safe across process
boundaries) via the transport directly:

```php
$dualEntry->getTransport()->request(
    'POST',
    'invoices/',
    json: $payload,
    headers: ['Idempotency-Key' => $yourKey],
);
```

Or disable auto-generation globally with `'auto_idempotency_keys' => false`
in `DualEntryClient::make()`.

## Attachments

```php
$dualEntry->invoices()->uploadAttachments(10042, [
    '/path/to/receipt.pdf',
    '/path/to/photo.jpg',
]);

// Invoices additionally support replacing the whole attachment set in one call:
$dualEntry->invoices()->replaceAttachments(10042, ['/path/to/final.pdf']);
```

## Laravel bridge (optional)

This package has zero dependency on Laravel — the bridge only activates if
your app has `illuminate/support` installed, and relies entirely on
[package auto-discovery](https://laravel.com/docs/packages#package-discovery)
to register the service provider and facade. There's nothing to add to
`bootstrap/providers.php` or `config/app.php`.

Publish the config and set your key:

```bash
php artisan vendor:publish --tag=dualentry-config
```

```dotenv
DUALENTRY_API_KEY=org_production_xxxxxxxxxxxxxxxx
```

Then resolve the client via the container, facade, or `dualentry` alias:

```php
use FoundryCo\DualEntry\DualEntryClient;
use FoundryCo\DualEntry\Laravel\Facades\DualEntry;

class SyncInvoices
{
    public function __construct(private readonly DualEntryClient $dualEntry)
    {
    }

    public function __invoke(): void
    {
        foreach ($this->dualEntry->invoices()->paginate() as $invoice) {
            // ...
        }
    }
}

// or
DualEntry::invoices()->find(10042);
app('dualentry')->invoices()->find(10042);
```

## Testing this package

```bash
composer install
composer test
```

The test suite drives `GuzzleTransport` against Guzzle's `MockHandler`, so
it runs with no network access and no live API key.

## API coverage

This client targets API **v2**, which DualEntry recommends for new
integrations (see DualEntry's
[versioning policy](https://docs.dualentry.com/developers/guides/versioning-policy)).
v1 is not supported.

## License

MIT
