<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->admin = User::where('email', 'admin@divyansh.dev')->first();
    }

    public function test_guest_is_redirected_from_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@divyansh.dev',
            'password' => 'Admin12345!',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($this->admin);
    }

    public function test_admin_can_view_dashboard_and_crud_projects(): void
    {
        $this->actingAs($this->admin);

        // 1. View Dashboard
        $dashResponse = $this->get('/admin/dashboard');
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Dashboard Overview');

        // 2. View Projects List
        $projListResponse = $this->get('/admin/projects');
        $projListResponse->assertStatus(200);
        $projListResponse->assertSee('Taxwale Web Panel');

        // 3. Create Project
        $createResponse = $this->post('/admin/projects', [
            'title' => 'New AI Application',
            'slug' => 'new-ai-application',
            'subtitle' => 'Machine Learning Platform',
            'description' => 'A modern AI web application.',
            'tags_string' => 'Laravel, AI, Python',
            'category' => 'Full-stack',
            'period' => '2026',
            'role_type' => 'Architecture ↗',
            'link' => 'https://example.com/ai',
            'art_type' => 'tax',
            'art_headline' => 'AI Powered Intelligence',
            'is_featured' => 1,
            'sort_order' => 10,
        ]);

        $createResponse->assertRedirect('/admin/projects');
        $this->assertDatabaseHas('projects', ['slug' => 'new-ai-application']);

        // 4. Update Project
        $project = Project::where('slug', 'new-ai-application')->first();
        $updateResponse = $this->put("/admin/projects/{$project->id}", [
            'title' => 'Updated AI Application',
            'slug' => 'new-ai-application',
            'subtitle' => 'Machine Learning Platform',
            'description' => 'Updated description text.',
            'tags_string' => 'Laravel, AI, Python, Vue',
            'category' => 'Full-stack',
            'art_type' => 'tax',
            'art_headline' => 'AI Powered Intelligence',
            'is_featured' => 1,
            'sort_order' => 10,
        ]);

        $updateResponse->assertRedirect('/admin/projects');
        $this->assertDatabaseHas('projects', ['title' => 'Updated AI Application']);

        // 5. Delete Project
        $deleteResponse = $this->delete("/admin/projects/{$project->id}");
        $deleteResponse->assertRedirect('/admin/projects');
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_admin_can_manage_messages(): void
    {
        $this->actingAs($this->admin);

        $msg = ContactMessage::create([
            'name' => 'Jane Client',
            'email' => 'jane@client.com',
            'subject' => 'Project Inquiry',
            'message' => 'Need help with Laravel migration.',
            'is_read' => false,
        ]);

        // View single message & mark as read
        $response = $this->get("/admin/messages/{$msg->id}");
        $response->assertStatus(200);
        $response->assertSee('Jane Client');

        $this->assertTrue($msg->fresh()->is_read);

        // Toggle read status
        $this->post("/admin/messages/{$msg->id}/toggle-read");
        $this->assertFalse($msg->fresh()->is_read);

        // Delete message
        $this->delete("/admin/messages/{$msg->id}");
        $this->assertDatabaseMissing('contact_messages', ['id' => $msg->id]);
    }
}

