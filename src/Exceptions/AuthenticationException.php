<?php

namespace FoundryCo\DualEntry\Exceptions;

/**
 * 401/403 — missing, unknown, revoked API key, or a valid key without the
 * required role ("Access denied").
 */
class AuthenticationException extends ApiException {}
