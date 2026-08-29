@extends('layouts.app')

@section('content')
<main id="top">
  <!-- HERO SECTION -->
  <section class="wrap hero">
    <div class="reveal">
      <div class="eyebrow mono">
        {{ $settings['hero_eyebrow'] ?? 'Delhi, India · Available for opportunities' }}
      </div>
      <h1>
        {!! $settings['hero_headline'] ?? 'Digital work with <em>a point<br />of view.</em>' !!}
      </h1>
      <p class="hero-copy">
        {{ $settings['hero_copy'] ?? "I'm Divyansh Chawla - a UI/UX designer and web developer turning ambitious ideas into useful, polished digital products." }}
      </p>
      <div class="actions">
        <a class="button dark" href="#work">Explore selected work ↓</a>
        <a class="button light" href="#say-hello">Start a conversation ↗</a>
      </div>
    </div>
    <div class="hero-side reveal" aria-hidden="true">
      <div class="orbit">
        <b>DESIGN<br />×<br />BUILD</b>
        <div class="note one">Figma to production</div>
        <div class="note two">Details matter</div>
      </div>
    </div>
  </section>

  <!-- MARQUEE STRIP -->
  <div class="marquee" aria-hidden="true">
    <div>
      @php
        $marqueeText = $settings['marquee_items'] ?? 'UI/UX DESIGN ✳ WEB DEVELOPMENT ✳ DESIGN SYSTEMS ✳ LARAVEL BUILDS ✳ API ARCHITECTURE';
      @endphp
      {{ $marqueeText }} &nbsp; ✳ &nbsp; {{ $marqueeText }} &nbsp; ✳ &nbsp;
    </div>
    <div>
      {{ $marqueeText }} &nbsp; ✳ &nbsp; {{ $marqueeText }} &nbsp; ✳ &nbsp;
    </div>
  </div>

  <!-- ABOUT SECTION -->
  <section id="about" class="wrap">
    <div class="head reveal">
      <div class="mono">01 / a little context</div>
      <div>
        <h2>{!! $settings['about_heading'] ?? 'Built for the space between <em>idea</em> and impact.' !!}</h2>
        <p class="intro">
          {{ $settings['about_intro'] ?? 'I work across design and development, so a project stays coherent from the first wireframe to the final handoff. My approach is curious, practical and obsessively user-aware.' }}
        </p>
      </div>
    </div>
    <div class="about reveal">
      <article class="statement">
        <p>
          {!! $settings['about_statement'] ?? 'Real-world products need more than a beautiful screen. They need clear systems, <em>intentional details</em> and a build that holds up.' !!}
        </p>
        <span class="mono">{{ $settings['about_badge'] ?? 'UI/UX Designer · Web Developer' }}</span>
      </article>
      <div class="facts">
        @forelse($facts as $fact)
          <div class="fact">
            <strong>{{ $fact->value }}</strong>
            <p>{{ $fact->label }}</p>
          </div>
        @empty
          <div class="fact">
            <strong>50+</strong>
            <p>screens designed for a financial services mobile app</p>
          </div>
          <div class="fact">
            <strong>500+</strong>
            <p>components and variables in a scalable design system</p>
          </div>
          <div class="fact">
            <strong>20+</strong>
            <p>micro-interactions designed per key product screen</p>
          </div>
          <div class="fact">
            <strong>01→∞</strong>
            <p>ownership from requirements through deployment</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- SELECTED WORK / PROJECTS -->
  <section id="work" class="work">
    <div class="wrap">
      <div class="head reveal">
        <div class="mono">02 / selected work</div>
        <div>
          <h2>Work made to move people <em>forward.</em></h2>
          <p class="intro">
            A selection of product design and full-stack work for real businesses.
          </p>
        </div>
      </div>

      @forelse($projects as $project)
        <article class="card reveal">
          <div class="art {{ $project->art_type }}">
            @if($project->art_type === 'tax')
              <div class="screen" data-art-headline="{{ $project->art_headline ?? 'Your money, in focus' }}"></div>
              <div class="pill"></div>
            @elseif($project->art_type === 'bhoomi')
              <div class="window" data-art-headline="{{ $project->art_headline ?? "Sustainable solutions\nfor a cleaner tomorrow" }}"></div>
              <div class="leaf"></div>
            @elseif($project->art_type === 'core')
              <div class="dash" data-art-headline="{{ $project->art_headline ?? 'Content, managed.' }}"><div class="bars"></div></div>
            @else
              <div style="font-size: 20px; font-weight: 800; font-family: 'Bricolage Grotesque', sans-serif;">
                {{ $project->art_headline ?? $project->title }}
              </div>
            @endif
          </div>
          <div class="copy">
            <div>
              <div class="tags">
                @if(is_array($project->tags))
                  @foreach($project->tags as $tag)
                    <span class="tag">{{ $tag }}</span>
                  @endforeach
                @endif
              </div>
              <h3>{!! nl2br(e($project->title)) !!}</h3>
              <p>{{ $project->description }}</p>
            </div>
            <div class="meta mono">
              <span>{{ $project->period ?? '2025' }}</span>
              @if($project->link && $project->link !== '#')
                <a href="{{ $project->link }}" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: underline;">
                  {{ $project->role_type ?? 'View Project ↗' }}
                </a>
              @else
                <span>{{ $project->role_type ?? 'Featured Project ↗' }}</span>
              @endif
            </div>
          </div>
        </article>
      @empty
        <p style="color: #c1c1b9; padding: 40px 0;">No projects added yet.</p>
      @endforelse
    </div>
  </section>

  <!-- EXPERIENCE TIMELINE -->
  <section id="experience" class="wrap">
    <div class="head reveal">
      <div class="mono">03 / experience</div>
      <div>
        <h2>Learning by <em>doing the work.</em></h2>
      </div>
    </div>
    <div class="exp-list reveal">
      @forelse($experiences as $exp)
        <article class="exp">
          <div class="mono">
            {{ $exp->period }}<br />
            {{ $exp->location }}
          </div>
          <div>
            <p class="role mono">{{ $exp->company }}</p>
            <h3>{{ $exp->role }}</h3>
          </div>
          <p>{{ $exp->description }}</p>
        </article>
      @empty
        <p style="color: var(--muted); padding: 20px 0;">No experience entries available.</p>
      @endforelse
    </div>
  </section>

  <!-- TOOLKIT / SKILLS -->
  <section id="toolkit" class="wrap toolkit-section">
    <div class="head reveal">
      <div class="mono">04 / toolkit</div>
      <div>
        <h2>Capabilities that <em>connect the dots.</em></h2>
      </div>
    </div>
    <div class="tools reveal">
      @forelse($skills as $skill)
        <article class="tool">
          <span class="mono">{{ $skill->number }}</span>
          <div>
            <h3>{{ $skill->title }}</h3>
            <p>{{ $skill->description }}</p>
          </div>
        </article>
      @empty
        <article class="tool">
          <span class="mono">01</span>
          <div>
            <h3>Full-Stack Development</h3>
            <p>Laravel, PHP, MySQL, REST APIs, responsive Blade templates</p>
          </div>
        </article>
      @endforelse
    </div>
  </section>

  <!-- CONTACT & SAY HELLO SECTION -->
  <section id="say-hello" class="contact">
    <div class="wrap">
      <div class="mono">05 / say hello</div>
      <h2>{!! $settings['contact_heading'] ?? "Have a good idea?<br /><em>Let's give it a home.</em>" !!}</h2>

      <div class="contact-row">
        <span class="mono">{{ $settings['contact_subtext'] ?? 'For opportunities, freelance & collaboration' }}</span>
        <span class="mono" style="font-size: clamp(1rem, 2vw, 1.6rem); font-weight: 700;">
          Leave a message below ↘
        </span>
      </div>

      <!-- Functional Contact Form Grid -->
      <div class="contact-grid reveal">
        <div>
          <h3 style="font-size: 26px; font-family: 'Bricolage Grotesque', sans-serif; margin-top: 0; margin-bottom: 12px; letter-spacing: -0.05em;">
            Send a direct message
          </h3>
          <p style="color: #444; font-size: 14px; line-height: 1.6; margin-bottom: 24px;">
            Whether you have a product to design, a full-stack Laravel application to build, or a question about my work, drop a note here and it goes straight to my dashboard.
          </p>
          <div style="font-family: 'DM Mono', monospace; font-size: 12px; color: #555;">
            <div><strong>AVAILABILITY:</strong> Open for opportunities & freelance</div>
            <div style="margin-top: 6px;"><strong>RESPONSE TIME:</strong> Usually within 24 hours</div>
            <div style="margin-top: 6px;"><strong>LOCATION:</strong> Delhi, India</div>
          </div>
        </div>

        <div>
          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          @if($errors->any())
            <div class="alert alert-danger">
              <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('contact.submit') }}" method="POST" id="contact-form">
            @csrf
            <div class="form-group">
              <label for="name" class="form-label mono">Your Name *</label>
              <input type="text" name="name" id="name" class="form-input" value="{{ old('name') }}" placeholder="e.g. Alex Sharma" required />
            </div>

            <div class="form-group">
              <label for="email" class="form-label mono">Email Address *</label>
              <input type="email" name="email" id="email" class="form-input" value="{{ old('email') }}" placeholder="alex@example.com" required />
            </div>

            <div class="form-group">
              <label for="subject" class="form-label mono">Subject</label>
              <input type="text" name="subject" id="subject" class="form-input" value="{{ old('subject') }}" placeholder="Project inquiry / collaboration" />
            </div>

            <div class="form-group">
              <label for="message" class="form-label mono">Message *</label>
              <textarea name="message" id="message" class="form-textarea" placeholder="Tell me about your project or idea..." required>{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="button dark" style="width: 100%; padding: 14px; font-size: 14px;">
              Send Message ↗
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection

