<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_creating_employee_dispatches_notification_job()
    {
        $user = User::factory()->create();
        $project = $user->projects()->create([
            'name' => 'Test Project',
            'description' => 'This is a test project.',
            'status' => 'active',
        ]); 
        $employeeData = [
            'name' => 'Kadiri Sunday',
        ];
        $employee = $project->employees()->create($employeeData);

    }
}
