<?php

namespace FoundryCo\DualEntry\Exceptions;

/**
 * A network-level failure (DNS, TLS, timeout, connection reset) that never
 * produced an HTTP response to parse.
 */
class TransportException extends DualEntryException {}
