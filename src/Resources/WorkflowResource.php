<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\Workflow;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Approval policies (workflows), their execution states, and roles.
 *
 * Workflows are read-only through the public API.
 */
final class WorkflowResource extends AbstractResource
{
    protected string $basePath = 'workflows/';

    /**
     * @return array<int, Workflow>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): Workflow => Workflow::fromWire($row),
            $this->performList($filters),
        );
    }

    /**
     * Lazily walk every page of the list endpoint and yield each record.
     */
    public function paginate(array $filters = []): Paginator
    {
        return new Paginator(fn (array $page) => $this->list($page), $filters);
    }

    public function find(int|string $id): Workflow
    {
        return Workflow::fromWire($this->performFind($id));
    }

    /**
     * Historical versions of a workflow's definition.
     */
    public function versions(int|string $workflowId, array $query = []): array
    {
        return $this->transport->request('GET', $this->itemPath($workflowId).'versions/', query: $query);
    }

    public function executionStates(array $query = []): array
    {
        return $this->transport->request('GET', $this->basePath.'execution-states/', query: $query);
    }

    public function executionState(int|string $stateId): array
    {
        return $this->transport->request('GET', $this->basePath.'execution-states/'.rawurlencode((string) $stateId).'/');
    }

    /**
     * Actions available on a given execution state (e.g. approve, reject).
     */
    public function executionStateActions(int|string $stateId): array
    {
        return $this->transport->request('GET', $this->basePath.'execution-states/'.rawurlencode((string) $stateId).'/actions/');
    }

    /**
     * All approval actions across the organization.
     */
    public function actions(array $query = []): array
    {
        $response = $this->transport->request('GET', $this->basePath.'actions/', query: $query);

        return $response['items'] ?? [];
    }

    /**
     * Roles that can participate in approval workflows.
     */
    public function roles(): array
    {
        return $this->transport->request('GET', $this->basePath.'roles/');
    }
}
