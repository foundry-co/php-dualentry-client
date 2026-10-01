<?php

namespace FoundryCo\DualEntry\Tests\Unit;

use FoundryCo\DualEntry\Support\Paginator;
use PHPUnit\Framework\TestCase;

final class PaginatorTest extends TestCase
{
    public function test_walks_pages_until_a_short_page_is_returned(): void
    {
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

        self::assertCount(5, $records);
        self::assertSame(
            [
                ['limit' => 2, 'offset' => 0],
                ['limit' => 2, 'offset' => 2],
                ['limit' => 2, 'offset' => 4],
            ],
            $calls,
        );
    }

    public function test_stops_immediately_on_an_empty_first_page(): void
    {
        $paginator = new Paginator(fn () => [], limit: 100);

        self::assertSame([], iterator_to_array($paginator->records(), false));
    }
}
