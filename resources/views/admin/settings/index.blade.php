@extends('layouts.admin')

@section('title', 'Site Settings & Profile')

@section('content')
<div style="display: grid; grid-template-columns: 1.4fr 1fr; gap: 24px;">
  <!-- Left Column: Site & Content Settings -->
  <div>
    <div class="card-box">
      <div class="card-header">
        <h2 class="card-title">Landing Page Content & Copy</h2>
      </div>

      <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf

        <h3 class="mono" style="font-size: 13px; color: var(--lime); margin-bottom: 16px; text-transform: uppercase;">Hero Section</h3>

        <div class="form-group">
          <label for="hero_eyebrow" class="form-label">Hero Eyebrow / Location Status</label>
          <input type="text" name="hero_eyebrow" id="hero_eyebrow" class="form-control" value="{{ old('hero_eyebrow', \App\Models\SiteSetting::get('hero_eyebrow')) }}" />
        </div>

        <div class="form-group">
          <label for="hero_headline" class="form-label">Hero Headline (HTML allowed for &lt;em&gt; &amp; &lt;br&gt;)</label>
          <input type="text" name="hero_headline" id="hero_headline" class="form-control" value="{{ old('hero_headline', \App\Models\SiteSetting::get('hero_headline')) }}" />
        </div>

        <div class="form-group">
          <label for="hero_copy" class="form-label">Hero Subtitle / Bio Intro</label>
          <textarea name="hero_copy" id="hero_copy" class="form-control" rows="3">{{ old('hero_copy', \App\Models\SiteSetting::get('hero_copy')) }}</textarea>
        </div>

        <div class="form-group">
          <label for="marquee_items" class="form-label">Marquee Strip Items</label>
          <input type="text" name="marquee_items" id="marquee_items" class="form-control" value="{{ old('marquee_items', \App\Models\SiteSetting::get('marquee_items')) }}" />
        </div>

        <hr style="border: 0; border-top: 1px solid var(--card-border); margin: 28px 0;">

        <h3 class="mono" style="font-size: 13px; color: var(--lime); margin-bottom: 16px; text-transform: uppercase;">About Section</h3>

        <div class="form-group">
          <label for="about_heading" class="form-label">About Heading</label>
          <input type="text" name="about_heading" id="about_heading" class="form-control" value="{{ old('about_heading', \App\Models\SiteSetting::get('about_heading')) }}" />
        </div>

        <div class="form-group">
          <label for="about_intro" class="form-label">About Intro Paragraph</label>
          <textarea name="about_intro" id="about_intro" class="form-control" rows="3">{{ old('about_intro', \App\Models\SiteSetting::get('about_intro')) }}</textarea>
        </div>

        <div class="form-group">
          <label for="about_statement" class="form-label">Statement Box Quote</label>
          <textarea name="about_statement" id="about_statement" class="form-control" rows="3">{{ old('about_statement', \App\Models\SiteSetting::get('about_statement')) }}</textarea>
        </div>

        <div class="form-group">
          <label for="about_badge" class="form-label">Statement Footer Badge</label>
          <input type="text" name="about_badge" id="about_badge" class="form-control" value="{{ old('about_badge', \App\Models\SiteSetting::get('about_badge')) }}" />
        </div>

        <hr style="border: 0; border-top: 1px solid var(--card-border); margin: 28px 0;">

        <h3 class="mono" style="font-size: 13px; color: var(--lime); margin-bottom: 16px; text-transform: uppercase;">Statistics &amp; Fact Grid</h3>

        @foreach($facts as $fact)
          <div style="display: grid; grid-template-columns: 120px 1fr 80px; gap: 12px; margin-bottom: 12px; align-items: center;">
            <div>
              <input type="text" name="facts[{{ $fact->id }}][value]" class="form-control" value="{{ $fact->value }}" placeholder="50+" />
            </div>
            <div>
              <input type="text" name="facts[{{ $fact->id }}][label]" class="form-control" value="{{ $fact->label }}" placeholder="Description" />
            </div>
            <div>
              <input type="number" name="facts[{{ $fact->id }}][sort_order]" class="form-control" value="{{ $fact->sort_order }}" placeholder="Order" />
            </div>
          </div>
        @endforeach

        <hr style="border: 0; border-top: 1px solid var(--card-border); margin: 28px 0;">

        <h3 class="mono" style="font-size: 13px; color: var(--lime); margin-bottom: 16px; text-transform: uppercase;">Contact &amp; Footer Info</h3>

        <div class="form-group">
          <label for="contact_heading" class="form-label">Contact Section Heading</label>
          <input type="text" name="contact_heading" id="contact_heading" class="form-control" value="{{ old('contact_heading', \App\Models\SiteSetting::get('contact_heading')) }}" />
        </div>

        <div class="form-group">
          <label for="contact_subtext" class="form-label">Contact Section Subtext</label>
          <input type="text" name="contact_subtext" id="contact_subtext" class="form-control" value="{{ old('contact_subtext', \App\Models\SiteSetting::get('contact_subtext')) }}" />
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group">
            <label for="footer_copyright" class="form-label">Footer Copyright</label>
            <input type="text" name="footer_copyright" id="footer_copyright" class="form-control" value="{{ old('footer_copyright', \App\Models\SiteSetting::get('footer_copyright')) }}" />
          </div>

          <div class="form-group">
            <label for="footer_tagline" class="form-label">Footer Tagline</label>
            <input type="text" name="footer_tagline" id="footer_tagline" class="form-control" value="{{ old('footer_tagline', \App\Models\SiteSetting::get('footer_tagline')) }}" />
          </div>
        </div>

        <div style="margin-top: 24px;">
          <button type="submit" class="btn btn-lime">Save Site Settings ↗</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Right Column: SEO & Admin Account Settings -->
  <div>
    <!-- SEO Settings -->
    <div class="card-box">
      <div class="card-header">
        <h2 class="card-title">SEO & Metadata</h2>
      </div>

      <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf

        <div class="form-group">
          <label for="site_title" class="form-label">Page Title (&lt;title&gt;)</label>
          <input type="text" name="site_title" id="site_title" class="form-control" value="{{ old('site_title', \App\Models\SiteSetting::get('site_title')) }}" />
        </div>

        <div class="form-group">
          <label for="meta_description" class="form-label">Meta Description</label>
          <textarea name="meta_description" id="meta_description" class="form-control" rows="3">{{ old('meta_description', \App\Models\SiteSetting::get('meta_description')) }}</textarea>
        </div>

        <div style="margin-top: 20px;">
          <button type="submit" class="btn btn-lime">Update SEO ↗</button>
        </div>
      </form>
    </div>

    <!-- Admin Account Profile -->
    <div class="card-box">
      <div class="card-header">
        <h2 class="card-title">Admin Account & Security</h2>
      </div>

      <form action="{{ route('admin.settings.profile') }}" method="POST">
        @csrf

        <div class="form-group">
          <label for="admin_name" class="form-label">Your Name</label>
          <input type="text" name="name" id="admin_name" class="form-control" value="{{ old('name', $user->name) }}" required />
        </div>

        <div class="form-group">
          <label for="admin_email" class="form-label">Admin Email</label>
          <input type="email" name="email" id="admin_email" class="form-control" value="{{ old('email', $user->email) }}" required />
        </div>

        <div class="form-group">
          <label for="current_password" class="form-label">Current Password (Required only if changing password)</label>
          <input type="password" name="current_password" id="current_password" class="form-control" />
        </div>

        <div class="form-group">
          <label for="new_password" class="form-label">New Password</label>
          <input type="password" name="password" id="new_password" class="form-control" placeholder="Leave empty to keep current" />
        </div>

        <div class="form-group">
          <label for="password_confirmation" class="form-label">Confirm New Password</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
        </div>

        <div style="margin-top: 20px;">
          <button type="submit" class="btn btn-primary">Update Profile ↗</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

