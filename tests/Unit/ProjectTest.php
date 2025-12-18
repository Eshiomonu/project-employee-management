<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_project_creation()
    {
        $user = User::factory()->create();
        $project = $user->projects()->create([
            'name' => 'Test Project',
            'description' => 'This is a test project.',
            'status' => 'active',
        ]);
    
        $this->assertEquals('Test Project', $project->name);
        $this->assertEquals('This is a test project.', $project->description);
    }

    public function test_user_cannot_access_another_users_project()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
    
        $project = $user1->projects()->create([
            'name' => 'User1 Project',
            'description' => 'This project belongs to user1.',
            'status' => 'active',
        ]);
    
        $this->assertFalse($user2->can('view', $project));
    }
}
