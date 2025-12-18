<?php

namespace App\Jobs;

use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendEmployeeCreatedNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(Employee $employee)
    {
        $this->employee = Employee;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        

    }

    public function store(StoreEmployeeRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->employees()->create($request->validated());

        return redirect()->route('projects.show', $project)->with('success', 'Employee added successfully.');
    }
}
