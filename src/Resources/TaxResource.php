<?php

namespace FoundryCo\DualEntry\Resources;

/**
 * Tax calculation. See
 * https://docs.dualentry.com/developers/guides/api/building-blocks/calculate-tax-before-invoicing
 */
final class TaxResource extends AbstractResource
{
    protected string $basePath = 'taxes/';

    /**
     * Calculate tax for a prospective invoice/bill before creating it.
     */
    public function calculate(array $payload): array
    {
        return $this->transport->request('POST', $this->basePath.'calculate/', json: $payload);
    }
}
