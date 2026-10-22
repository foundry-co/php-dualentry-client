<?php

use FoundryCo\DualEntry\Resources\Data\Customer;
use FoundryCo\DualEntry\Resources\Data\Vendor;

function vendorWithId(?int $id): Vendor
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

test('vendor uses the VN prefix', function () {
    expect(vendorWithId(42)->displayId())->toBe('VN-42');
});

test('a missing identifier returns null', function () {
    expect(vendorWithId(null)->displayId())->toBeNull();
});

test('a class without a prefix defaults to XX', function () {
    expect(Customer::idPrefix())->toBe('XX')
        ->and(Vendor::idPrefix())->toBe('VN');
});
