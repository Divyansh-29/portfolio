<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Fact;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Default Admin User
        User::firstOrCreate(
            ['email' => 'admin@divyansh.dev'],
            [
                'name' => 'Divyansh Chawla',
                'password' => Hash::make('Admin12345!'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // 2. Seed Projects
        $projects = [
            [
                'title' => 'Taxwale Web Panel',
                'slug' => 'taxwale-web-panel',
                'subtitle' => 'Fintech Web Panel',
                'description' => 'A structured, scalable web interface translated from an existing mobile product - complete with responsive layouts, reusable components, flows and interaction states.',
                'tags' => ['Figma', 'Product design', 'Fintech'],
                'category' => 'Product Design',
                'period' => '09/2025 - 11/2025',
                'role_type' => 'UI/UX Design ↗',
                'link' => '#',
                'repo_link' => null,
                'art_type' => 'tax',
                'art_headline' => 'Your money, in focus',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Bhoomija Envirocare',
                'slug' => 'bhoomija-envirocare',
                'subtitle' => 'Business & Environmental Solutions Website',
                'description' => 'A production business website built end-to-end with dynamic content, enquiry flows, API integrations and a smoother experience for a media-rich site.',
                'tags' => ['Laravel', 'PHP / SQL', 'Full-stack'],
                'category' => 'Web Development',
                'period' => '06/2025 - 08/2025',
                'role_type' => 'Build & deploy ↗',
                'link' => '#',
                'repo_link' => null,
                'art_type' => 'bhoomi',
                'art_headline' => "Sustainable solutions\nfor a cleaner tomorrow",
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Core Tech Info Business Site',
                'slug' => 'core-tech-info-business-site',
                'subtitle' => 'Database-driven Company Portal & CMS',
                'description' => 'A responsive, database-driven company website with dynamic modules for services, blogs, products, projects, people, enquiries and content.',
                'tags' => ['Laravel', 'CMS', 'Client work'],
                'category' => 'Full-stack Web',
                'period' => '04/2025 - 07/2025',
                'role_type' => 'Full-stack web ↗',
                'link' => '#',
                'repo_link' => null,
                'art_type' => 'core',
                'art_headline' => 'Content, managed.',
                'is_featured' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($projects as $proj) {
            Project::updateOrCreate(['slug' => $proj['slug']], $proj);
        }

        // 3. Seed Experiences
        $experiences = [
            [
                'company' => 'Core Tech Info',
                'role' => 'Junior Developer',
                'period' => '03/2025 - 12/2025',
                'location' => 'Delhi, India',
                'description' => 'Worked on client projects from requirement gathering and interface design through development, testing and deployment. Designed Figma prototypes, built responsive Laravel applications and supported production releases.',
                'sort_order' => 1,
            ],
            [
                'company' => 'Indira Gandhi National Open University',
                'role' => 'Bachelor of Computer Applications',
                'period' => '2024 - 2027',
                'location' => 'Current',
                'description' => 'Building practical experience alongside a BCA, with a focus on digital products, problem-solving and adaptable technical fluency.',
                'sort_order' => 2,
            ],
        ];

        foreach ($experiences as $index => $exp) {
            Experience::updateOrCreate(
                ['company' => $exp['company'], 'role' => $exp['role']],
                $exp
            );
        }

        // 4. Seed Skills / Toolkit
        $skills = [
            [
                'number' => '01',
                'title' => 'Product Design',
                'description' => 'Figma, wireframing, prototyping, user flows, responsive systems',
                'category' => 'Design',
                'sort_order' => 1,
            ],
            [
                'number' => '02',
                'title' => 'Front End',
                'description' => 'HTML, CSS, JavaScript, Bootstrap, responsive interfaces',
                'category' => 'Frontend',
                'sort_order' => 2,
            ],
            [
                'number' => '03',
                'title' => 'Back End',
                'description' => 'Laravel, PHP, MySQL, phpMyAdmin, REST APIs',
                'category' => 'Backend',
                'sort_order' => 3,
            ],
            [
                'number' => '04',
                'title' => 'Delivery',
                'description' => 'Testing, requirements, client communication, Git & GitHub',
                'category' => 'DevOps & Tooling',
                'sort_order' => 4,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['number' => $skill['number']], $skill);
        }

        // 5. Seed Facts
        $facts = [
            [
                'value' => '50+',
                'label' => 'screens designed for a financial services mobile app',
                'sort_order' => 1,
            ],
            [
                'value' => '500+',
                'label' => 'components and variables in a scalable design system',
                'sort_order' => 2,
            ],
            [
                'value' => '20+',
                'label' => 'micro-interactions designed per key product screen',
                'sort_order' => 3,
            ],
            [
                'value' => '01→∞',
                'label' => 'ownership from requirements through deployment',
                'sort_order' => 4,
            ],
        ];

        foreach ($facts as $index => $fact) {
            Fact::updateOrCreate(['label' => $fact['label']], $fact);
        }

        // 6. Seed Site Settings
        $settings = [
            ['key' => 'site_title', 'value' => 'Divyansh Chawla — UI/UX Designer & Web Developer', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Portfolio of Divyansh Chawla, UI/UX designer and web developer.', 'group' => 'seo'],
            ['key' => 'hero_eyebrow', 'value' => 'Delhi, India · Available for opportunities', 'group' => 'hero'],
            ['key' => 'hero_headline', 'value' => 'Digital work with <em>a point<br />of view.</em>', 'group' => 'hero'],
            ['key' => 'hero_copy', 'value' => "I'm Divyansh Chawla - a UI/UX designer and web developer turning ambitious ideas into useful, polished digital products.", 'group' => 'hero'],
            ['key' => 'marquee_items', 'value' => 'UI/UX DESIGN ✳ WEB DEVELOPMENT ✳ DESIGN SYSTEMS ✳ LARAVEL BUILDS ✳ API ARCHITECTURE ✳ AUTH & SECURITY', 'group' => 'hero'],
            ['key' => 'about_heading', 'value' => 'Built for the space between <em>idea</em> and impact.', 'group' => 'about'],
            ['key' => 'about_intro', 'value' => 'I work across design and development, so a project stays coherent from the first wireframe to the final handoff. My approach is curious, practical and obsessively user-aware.', 'group' => 'about'],
            ['key' => 'about_statement', 'value' => 'Real-world products need more than a beautiful screen. They need clear systems, <em>intentional details</em> and a build that holds up.', 'group' => 'about'],
            ['key' => 'about_badge', 'value' => 'UI/UX Designer · Web Developer', 'group' => 'about'],
            ['key' => 'contact_heading', 'value' => "Have a good idea?<br /><em>Let's give it a home.</em>", 'group' => 'contact'],
            ['key' => 'contact_subtext', 'value' => 'For opportunities, freelance & collaboration', 'group' => 'contact'],
            ['key' => 'footer_copyright', 'value' => '© 2026 Divyansh Chawla', 'group' => 'footer'],
            ['key' => 'footer_tagline', 'value' => 'Designed & built with intent', 'group' => 'footer'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}

