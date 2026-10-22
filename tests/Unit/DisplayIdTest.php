<?php

namespace FoundryCo\DualEntry\Tests\Unit;

use FoundryCo\DualEntry\Resources\Data\Customer;
use FoundryCo\DualEntry\Resources\Data\Vendor;
use PHPUnit\Framework\TestCase;

final class DisplayIdTest extends TestCase
{
    private function vendor(?int $id): Vendor
    {
        return Vendor::fromWire([
            'is_active' => true,
            'vendor_type' => 'x',
            'name' => 'n',
            'email' => 'e',
            'phone' => 'p',
            'website' => 'w',
            'id' => $id,
        ]);
    }

    public function test_vendor_uses_vn_prefix(): void
    {
        $this->assertSame('VN-42', $this->vendor(42)->displayId());
    }

    public function test_missing_identifier_returns_null(): void
    {
        $this->assertNull($this->vendor(null)->displayId());
    }

    public function test_class_without_a_prefix_defaults_to_xx(): void
    {
        $this->assertSame('XX', Customer::idPrefix());
        $this->assertSame('VN', Vendor::idPrefix());
    }
}
