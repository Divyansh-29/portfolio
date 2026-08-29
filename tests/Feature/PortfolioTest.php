<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Fact;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_portfolio_home_page_is_accessible_and_displays_dynamic_content(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Divyansh Chawla');
        $response->assertSee('Taxwale Web Panel');
        $response->assertSee('Bhoomija Envirocare');
        $response->assertSee('Core Tech Info');
        $response->assertSee('Product Design');
    }

    public function test_contact_form_submits_and_stores_in_database(): void
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'New Project Proposal',
            'message' => 'Hello Divyansh, I would like to discuss building a Laravel SaaS product with you.',
        ]);

        $response->assertRedirect('/#say-hello');
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'john@example.com',
            'name' => 'John Doe',
        ]);
    }

    public function test_api_endpoints_return_json_data(): void
    {
        // 1. Profile API
        $profileResponse = $this->getJson('/api/v1/profile');
        $profileResponse->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => ['profile', 'settings', 'facts']
            ]);

        // 2. Projects API
        $projectsResponse = $this->getJson('/api/v1/projects');
        $projectsResponse->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'count',
                'data' => [
                    '*' => ['id', 'title', 'slug', 'description', 'art_type']
                ]
            ]);

        // 3. Single Project API
        $singleResponse = $this->getJson('/api/v1/projects/taxwale-web-panel');
        $singleResponse->assertStatus(200)
            ->assertJsonPath('data.title', 'Taxwale Web Panel');

        // 4. Experiences API
        $expResponse = $this->getJson('/api/v1/experiences');
        $expResponse->assertStatus(200)
            ->assertJsonPath('status', 'success');

        // 5. Skills API
        $skillsResponse = $this->getJson('/api/v1/skills');
        $skillsResponse->assertStatus(200)
            ->assertJsonPath('status', 'success');

        // 6. Contact API
        $contactResponse = $this->postJson('/api/v1/contact', [
            'name' => 'API Client',
            'email' => 'api@example.com',
            'subject' => 'API Inquiry',
            'message' => 'Testing API inquiry submission.',
        ]);
        $contactResponse->assertStatus(201)
            ->assertJsonPath('status', 'success');
    }
}

