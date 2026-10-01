<?php

namespace FoundryCo\DualEntry\Exceptions;

/**
 * 400/422 — malformed request, field validation failures, or a replayed
 * Idempotency-Key whose payload doesn't match the original request.
 */
class ValidationException extends ApiException {}
