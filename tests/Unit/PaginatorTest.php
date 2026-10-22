<?php

use FoundryCo\DualEntry\Support\Paginator;

test('walks pages until a short page is returned', function () {
    $pages = [
        array_fill(0, 2, ['id' => 'a']),
        array_fill(0, 2, ['id' => 'b']),
        array_fill(0, 1, ['id' => 'c']),
    ];
    $calls = [];

    $paginator = new Paginator(
        function (array $query) use (&$pages, &$calls) {
            $calls[] = $query;

            return array_shift($pages);
        },
        limit: 2,
    );

    $records = iterator_to_array($paginator->records(), false);

    expect($records)->toHaveCount(5)
        ->and($calls)->toBe([
            ['limit' => 2, 'offset' => 0],
            ['limit' => 2, 'offset' => 2],
            ['limit' => 2, 'offset' => 4],
        ]);
});

test('stops immediately on an empty first page', function () {
    $paginator = new Paginator(fn () => [], limit: 100);

    expect(iterator_to_array($paginator->records(), false))->toBe([]);
});
