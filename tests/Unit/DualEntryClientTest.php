<?php

use FoundryCo\DualEntry\DualEntryClient;
use FoundryCo\DualEntry\Resources\Data\PurchaseOrder;
use FoundryCo\DualEntry\Resources\Data\PurchaseOrderLineItem;
use FoundryCo\DualEntry\Resources\InvoiceResource;
use FoundryCo\DualEntry\Transport\Transport;
use FoundryCo\DualEntry\ValueObjects\Address;
use FoundryCo\DualEntry\ValueObjects\Enums\PurchaseOrderBilledStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\PurchaseOrderLifecycleStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

function purchaseOrderResponseBody(): array
{
    return [
        'term_id' => null,
        'term_name' => '',
        'internal_id' => 9001,
        'number' => 1042,
        'date' => '2026-01-15',
        'company_id' => 1,
        'company_name' => 'Acme Co',
        'company_currency' => 'USD',
        'vendor_id' => 55,
        'vendor_name' => 'Acme Supplies',
        'currency_iso_4217_code' => 'USD',
        'exchange_rate' => '1.0',
        'billed_total' => '0.00',
        'due_total' => '300.00',
        'amount' => '300.00',
        'memo' => 'Office supplies',
        'items' => [[
            'id' => 501,
            'item_id' => 10,
            'position' => 1,
            'memo' => 'Paper',
            'quantity' => '2',
            'rate' => '150.00',
            'quantity_billed' => '0',
            'quantity_due' => '2',
            'net_amount' => '300.00',
            'tax_amount' => '0.00',
            'gross_amount' => '300.00',
            'amount' => '300.00',
            'item_type' => null,
            'hsn_sac_code' => null,
            'tax' => null,
            'is_billable' => false,
            'billable_customer_id' => null,
            'billable_customer_name' => null,
            'billable_project_id' => null,
            'billable_project_name' => null,
            'billable_markup_pct' => null,
            'expected_location_id' => null,
            'expected_location_name' => null,
            'classifications' => [],
        ]],
        'record_status' => 'posted',
        'billed_status' => 'unbilled',
        'lifecycle_status' => 'open',
        'created_at' => '2026-01-15T10:00:00Z',
        'updated_at' => '2026-01-15T10:00:00Z',
        'ship_from_address' => null,
        'ship_to_address' => ['street' => '1 Main St', 'city' => 'Austin', 'postal_code' => '73301'],
        'attachments' => [],
        'created_by' => null,
        'updated_by' => null,
        'approval_status' => null,
        'next_approvers' => null,
        'rejected_by' => null,
        'code' => null,
        'reference_number' => '',
        'expected_location_id' => null,
        'expected_location_name' => null,
    ];
}

test('resource accessors are cached', function () {
    $client = new DualEntryClient($this->createStub(Transport::class));

    expect($client->invoices())->toBeInstanceOf(InvoiceResource::class)
        ->and($client->invoices())->toBe($client->invoices());
});

test('make builds a non existing record', function () {
    $purchaseOrder = PurchaseOrder::make(
        date: '2026-01-15',
        companyId: 1,
        vendorId: 55,
        currencyIso4217Code: SystemCurrencies::Usd,
        exchangeRate: '1.0',
        memo: 'Office supplies',
        items: [],
    );

    expect($purchaseOrder->exists)->toBeFalse();
});

test('the constructor cannot be called directly', function () {
    new PurchaseOrder(
        date: '2026-01-15',
        companyId: 1,
        vendorId: 55,
        currencyIso4217Code: SystemCurrencies::Usd,
        exchangeRate: '1.0',
        memo: 'Office supplies',
        items: [],
        exists: true,
    );
})->throws(Error::class, 'private');

test('with returns a new instance and preserves exists', function () {
    $original = PurchaseOrder::fromWire(purchaseOrderResponseBody());

    $tweaked = $original->with(['memo' => 'Updated memo']);

    expect($tweaked)->not->toBe($original)
        ->and($original->memo)->toBe('Office supplies')
        ->and($tweaked->memo)->toBe('Updated memo')
        ->and($tweaked->exists)->toBeTrue();
});

test('withX magic method mutates a single field', function () {
    $purchaseOrder = PurchaseOrder::fromWire(purchaseOrderResponseBody());

    $tweaked = $purchaseOrder->withMemo('Updated via withX');

    expect($tweaked->memo)->toBe('Updated via withX')
        ->and($tweaked->number)->toBe($purchaseOrder->number);
});

test('withX throws for an unknown field', function () {
    PurchaseOrder::fromWire(purchaseOrderResponseBody())->withNotARealField('x');
})->throws(BadMethodCallException::class);

test('purchase order create round trip', function () {
    $record = PurchaseOrder::make(
        date: '2026-01-15',
        companyId: 1,
        vendorId: 55,
        currencyIso4217Code: SystemCurrencies::Usd,
        exchangeRate: '1.0',
        memo: 'Office supplies',
        items: [
            new PurchaseOrderLineItem(
                position: 1,
                itemId: 10,
                memo: 'Paper',
                quantity: '2',
                rate: '150.00',
                classifications: [],
            ),
        ],
        shipToAddress: new Address(street: '1 Main St', city: 'Austin', postalCode: '73301'),
    );

    expect($record->exists)->toBeFalse();

    $expectedRequestBody = [
        'date' => '2026-01-15',
        'company_id' => 1,
        'vendor_id' => 55,
        'currency_iso_4217_code' => 'USD',
        'exchange_rate' => '1.0',
        'memo' => 'Office supplies',
        'items' => [[
            'position' => 1,
            'item_id' => 10,
            'memo' => 'Paper',
            'quantity' => '2',
            'rate' => '150.00',
            'classifications' => [],
        ]],
        'ship_to_address' => [
            'street' => '1 Main St',
            'city' => 'Austin',
            'postal_code' => '73301',
        ],
    ];

    expect($record->toWire())->toBe($expectedRequestBody);

    $transport = $this->createMock(Transport::class);
    $transport->expects($this->once())
        ->method('request')
        ->with('POST', 'purchase-orders/', [], $expectedRequestBody, null, [], true)
        ->willReturn(purchaseOrderResponseBody());

    $purchaseOrder = (new DualEntryClient($transport))->purchaseOrders()->create($record);

    expect($purchaseOrder)->toBeInstanceOf(PurchaseOrder::class)
        ->and($purchaseOrder->exists)->toBeTrue()
        ->and($purchaseOrder->number)->toBe(1042)
        ->and($purchaseOrder->recordStatus)->toBe(RecordStatus::Posted)
        ->and($purchaseOrder->billedStatus)->toBe(PurchaseOrderBilledStatus::Unbilled)
        ->and($purchaseOrder->lifecycleStatus)->toBe(PurchaseOrderLifecycleStatus::Open)
        ->and($purchaseOrder->currencyIso4217Code)->toBe(SystemCurrencies::Usd)
        ->and($purchaseOrder->items)->toHaveCount(1)
        ->and($purchaseOrder->items[0]->itemId)->toBe(10)
        ->and($purchaseOrder->shipToAddress?->city)->toBe('Austin');
});

test('replace sends a fetched and tweaked record', function () {
    $transport = $this->createMock(Transport::class);
    $transport->expects($this->once())
        ->method('request')
        ->with(
            'PUT',
            'purchase-orders/1042/',
            [],
            $this->callback(fn (array $body): bool => $body['memo'] === 'Corrected memo'),
            null,
            [],
            true,
        )
        ->willReturn([...purchaseOrderResponseBody(), 'memo' => 'Corrected memo']);

    $fetched = PurchaseOrder::fromWire(purchaseOrderResponseBody());

    $updated = (new DualEntryClient($transport))->purchaseOrders()->replace(1042, $fetched->withMemo('Corrected memo'));

    expect($updated->memo)->toBe('Corrected memo');
});

test('update takes a plain wire format array', function () {
    $transport = $this->createMock(Transport::class);
    $transport->expects($this->once())
        ->method('request')
        ->with('PATCH', 'invoices/42/', [], ['due_date' => '2026-03-01'], null, [], true)
        ->willReturn(['date' => '2026-01-15', 'due_date' => '2026-03-01']);

    (new DualEntryClient($transport))->invoices()->update(42, ['due_date' => '2026-03-01']);
});

test('invoice send posts to the send endpoint', function () {
    $transport = $this->createMock(Transport::class);
    $transport->expects($this->once())
        ->method('request')
        ->with('POST', 'invoices/42/send/', [], ['to' => 'customer@example.com'], null, [], true)
        ->willReturn(['status' => 'sent']);

    $result = (new DualEntryClient($transport))->invoices()->send(42, ['to' => 'customer@example.com']);

    expect($result)->toBe(['status' => 'sent']);
});
