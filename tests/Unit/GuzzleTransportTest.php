<?php

use FoundryCo\DualEntry\Exceptions\AuthenticationException;
use FoundryCo\DualEntry\Exceptions\NotFoundException;
use FoundryCo\DualEntry\Exceptions\RateLimitException;
use FoundryCo\DualEntry\Exceptions\ValidationException;
use FoundryCo\DualEntry\Transport\GuzzleTransport;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;

function makeTransport(array $responses, int $maxRetries = 0, array &$history = []): GuzzleTransport
{
    $mock = new MockHandler($responses);
    $stack = HandlerStack::create($mock);
    $stack->push(Middleware::history($history));

    $client = new Client([
        'base_uri' => GuzzleTransport::PRODUCTION_BASE_URI,
        'handler' => $stack,
        'headers' => ['X-API-KEY' => 'org_production_testkey1234'],
    ]);

    return new GuzzleTransport($client, $maxRetries);
}

test('sends the api key header and decodes json', function () {
    $history = [];
    $transport = makeTransport([
        new Response(200, ['Content-Type' => 'application/json'], json_encode([['id' => 1]])),
    ], history: $history);

    $result = $transport->request('GET', 'invoices/');

    expect($result)->toBe([['id' => 1]])
        ->and($history[0]['request']->getHeaderLine('X-API-KEY'))->toBe('org_production_testkey1234')
        ->and($history[0]['request']->getUri()->getPath())->toBe('/public/v2/invoices/');
});

test('query parameters are sent', function () {
    $history = [];
    $transport = makeTransport([
        new Response(200, [], json_encode([])),
    ], history: $history);

    $transport->request('GET', 'invoices/', query: ['limit' => 10, 'offset' => 20]);

    parse_str($history[0]['request']->getUri()->getQuery(), $query);
    expect($query)->toBe(['limit' => '10', 'offset' => '20']);
});

test('write requests get an idempotency key by default', function () {
    $history = [];
    $transport = makeTransport([
        new Response(201, [], json_encode(['id' => 1])),
    ], history: $history);

    $transport->request('POST', 'invoices/', json: ['memo' => 'test'], idempotent: true);

    expect($history[0]['request']->getHeaderLine('Idempotency-Key'))->not->toBeEmpty();
});

test('get requests do not get an idempotency key', function () {
    $history = [];
    $transport = makeTransport([
        new Response(200, [], json_encode([])),
    ], history: $history);

    $transport->request('GET', 'invoices/');

    expect($history[0]['request']->getHeaderLine('Idempotency-Key'))->toBe('');
});

test('401 maps to authentication exception', function () {
    $transport = makeTransport([
        new Response(401, [], json_encode([
            'success' => false,
            'errors' => ['__all__' => ['API key authentication failed']],
        ])),
    ]);

    try {
        $transport->request('GET', 'invoices/');
    } catch (AuthenticationException $exception) {
        expect($exception->getGeneralErrors())->toBe(['API key authentication failed']);

        return;
    }

    $this->fail('Expected an AuthenticationException');
});

test('404 maps to not found exception', function () {
    $transport = makeTransport([
        new Response(404, [], json_encode(['success' => false, 'errors' => []])),
    ]);

    $transport->request('GET', 'invoices/999999/');
})->throws(NotFoundException::class);

test('422 maps to validation exception with field errors', function () {
    $transport = makeTransport([
        new Response(422, [], json_encode([
            'success' => false,
            'errors' => ['customer_id' => ['This field is required.']],
        ])),
    ]);

    try {
        $transport->request('POST', 'invoices/', json: []);
    } catch (ValidationException $exception) {
        expect($exception->getFieldErrors('customer_id'))->toBe(['This field is required.']);

        return;
    }

    $this->fail('Expected a ValidationException');
});

test('429 maps to rate limit exception with retry after', function () {
    $transport = makeTransport([
        new Response(429, ['Retry-After' => '5'], json_encode([
            'success' => false,
            'errors' => ['__all__' => ['Too many requests.']],
        ])),
    ]);

    try {
        $transport->request('GET', 'invoices/');
    } catch (RateLimitException $exception) {
        expect($exception->getRetryAfterSeconds())->toBe(5);

        return;
    }

    $this->fail('Expected a RateLimitException');
});

test('retries 429 and succeeds', function () {
    $history = [];
    $transport = makeTransport([
        new Response(429, ['Retry-After' => '0'], json_encode(['success' => false, 'errors' => []])),
        new Response(200, [], json_encode(['id' => 1])),
    ], maxRetries: 1, history: $history);

    $result = $transport->request('GET', 'invoices/1/');

    expect($result)->toBe(['id' => 1])
        ->and($history)->toHaveCount(2);
});

test('rate limit headers are captured', function () {
    $transport = makeTransport([
        new Response(200, [
            'X-RateLimit-Limit' => '50',
            'X-RateLimit-Remaining' => '37',
            'X-RateLimit-Reset' => '1700000000',
        ], json_encode([])),
    ]);

    $transport->request('GET', 'invoices/');
    $rateLimit = $transport->getLastRateLimit();

    expect($rateLimit->limit)->toBe(50)
        ->and($rateLimit->remaining)->toBe(37)
        ->and($rateLimit->resetAt)->toBe(1700000000);
});
