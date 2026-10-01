<?php

namespace FoundryCo\DualEntry\Tests\Unit;

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
use PHPUnit\Framework\TestCase;

final class DualEntryClientTest extends TestCase
{
    public function test_resource_accessors_are_cached(): void
    {
        $client = new DualEntryClient($this->createStub(Transport::class));

        self::assertInstanceOf(InvoiceResource::class, $client->invoices());
        self::assertSame($client->invoices(), $client->invoices());
    }

    public function test_make_builds_a_non_existing_record(): void
    {
        $purchaseOrder = PurchaseOrder::make(
            date: '2026-01-15',
            companyId: 1,
            vendorId: 55,
            currencyIso4217Code: SystemCurrencies::Usd,
            exchangeRate: '1.0',
            memo: 'Office supplies',
            items: [],
        );

        self::assertFalse($purchaseOrder->exists);
    }

    public function test_the_constructor_cannot_be_called_directly(): void
    {
        $this->expectException(\Error::class);
        $this->expectExceptionMessageMatches('/private.*__construct/');

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
    }

    public function test_with_returns_a_new_instance_and_preserves_exists(): void
    {
        $original = PurchaseOrder::fromWire($this->purchaseOrderResponseBody());

        $tweaked = $original->with(['memo' => 'Updated memo']);

        self::assertNotSame($original, $tweaked);
        self::assertSame('Office supplies', $original->memo);
        self::assertSame('Updated memo', $tweaked->memo);
        self::assertTrue($tweaked->exists);
    }

    public function test_with_x_magic_method_mutates_a_single_field(): void
    {
        $purchaseOrder = PurchaseOrder::fromWire($this->purchaseOrderResponseBody());

        $tweaked = $purchaseOrder->withMemo('Updated via withX');

        self::assertSame('Updated via withX', $tweaked->memo);
        self::assertSame($purchaseOrder->number, $tweaked->number);
    }

    public function test_with_x_throws_for_an_unknown_field(): void
    {
        $purchaseOrder = PurchaseOrder::fromWire($this->purchaseOrderResponseBody());

        $this->expectException(\BadMethodCallException::class);

        $purchaseOrder->withNotARealField('x');
    }

    public function test_purchase_order_create_round_trip(): void
    {
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

        self::assertFalse($record->exists);

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

        self::assertSame($expectedRequestBody, $record->toWire());

        $transport = $this->createMock(Transport::class);
        $transport->expects(self::once())
            ->method('request')
            ->with('POST', 'purchase-orders/', [], $expectedRequestBody, null, [], true)
            ->willReturn($this->purchaseOrderResponseBody());

        $client = new DualEntryClient($transport);
        $purchaseOrder = $client->purchaseOrders()->create($record);

        self::assertInstanceOf(PurchaseOrder::class, $purchaseOrder);
        self::assertTrue($purchaseOrder->exists);
        self::assertSame(1042, $purchaseOrder->number);
        self::assertSame(RecordStatus::Posted, $purchaseOrder->recordStatus);
        self::assertSame(PurchaseOrderBilledStatus::Unbilled, $purchaseOrder->billedStatus);
        self::assertSame(PurchaseOrderLifecycleStatus::Open, $purchaseOrder->lifecycleStatus);
        self::assertSame(SystemCurrencies::Usd, $purchaseOrder->currencyIso4217Code);
        self::assertCount(1, $purchaseOrder->items);
        self::assertSame(10, $purchaseOrder->items[0]->itemId);
        self::assertSame('Austin', $purchaseOrder->shipToAddress?->city);
    }

    public function test_replace_sends_a_fetched_and_tweaked_record(): void
    {
        $transport = $this->createMock(Transport::class);
        $transport->expects(self::once())
            ->method('request')
            ->with(
                'PUT',
                'purchase-orders/1042/',
                [],
                self::callback(fn (array $body): bool => $body['memo'] === 'Corrected memo'),
                null,
                [],
                true,
            )
            ->willReturn([...$this->purchaseOrderResponseBody(), 'memo' => 'Corrected memo']);

        $client = new DualEntryClient($transport);
        $fetched = PurchaseOrder::fromWire($this->purchaseOrderResponseBody());

        $updated = $client->purchaseOrders()->replace(1042, $fetched->withMemo('Corrected memo'));

        self::assertSame('Corrected memo', $updated->memo);
    }

    public function test_update_takes_a_plain_wire_format_array(): void
    {
        $transport = $this->createMock(Transport::class);
        $transport->expects(self::once())
            ->method('request')
            ->with('PATCH', 'invoices/42/', [], ['due_date' => '2026-03-01'], null, [], true)
            ->willReturn(['date' => '2026-01-15', 'due_date' => '2026-03-01']);

        $client = new DualEntryClient($transport);

        $client->invoices()->update(42, ['due_date' => '2026-03-01']);
    }

    public function test_invoice_send_posts_to_the_send_endpoint(): void
    {
        $transport = $this->createMock(Transport::class);
        $transport->expects(self::once())
            ->method('request')
            ->with('POST', 'invoices/42/send/', [], ['to' => 'customer@example.com'], null, [], true)
            ->willReturn(['status' => 'sent']);

        $client = new DualEntryClient($transport);

        self::assertSame(['status' => 'sent'], $client->invoices()->send(42, ['to' => 'customer@example.com']));
    }

    private function purchaseOrderResponseBody(): array
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
}
