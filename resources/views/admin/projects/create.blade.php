@extends('layouts.admin')

@section('title', 'Create Project')

@section('content')
<div class="card-box" style="max-width: 800px;">
  <div class="card-header">
    <h2 class="card-title">Add New Project</h2>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary" style="font-size: 11px;">← Back to Projects</a>
  </div>

  <form action="{{ route('admin.projects.store') }}" method="POST">
    @csrf

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <div class="form-group">
        <label for="title" class="form-label">Project Title *</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required placeholder="e.g. Taxwale Web Panel" />
      </div>

      <div class="form-group">
        <label for="slug" class="form-label">Slug (URL friendly)</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" placeholder="taxwale-web-panel (auto generated if empty)" />
      </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <div class="form-group">
        <label for="subtitle" class="form-label">Subtitle</label>
        <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ old('subtitle') }}" placeholder="e.g. Fintech Web Platform" />
      </div>

      <div class="form-group">
        <label for="category" class="form-label">Category</label>
        <input type="text" name="category" id="category" class="form-control" value="{{ old('category') }}" placeholder="e.g. Product Design, Full-stack" />
      </div>
    </div>

    <div class="form-group">
      <label for="description" class="form-label">Description *</label>
      <textarea name="description" id="description" class="form-control" rows="4" required placeholder="Describe the project overview and your contribution...">{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
      <label for="tags_string" class="form-label">Tags (comma separated)</label>
      <input type="text" name="tags_string" id="tags_string" class="form-control" value="{{ old('tags_string') }}" placeholder="Laravel, PHP, MySQL, Product Design" />
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
      <div class="form-group">
        <label for="art_type" class="form-label">Visual Art Badge *</label>
        <select name="art_type" id="art_type" class="form-control" required>
          <option value="tax" {{ old('art_type') == 'tax' ? 'selected' : '' }}>Taxwale (Violet/Sky screen)</option>
          <option value="bhoomi" {{ old('art_type') == 'bhoomi' ? 'selected' : '' }}>Bhoomija (Mint window + leaf)</option>
          <option value="core" {{ old('art_type') == 'core' ? 'selected' : '' }}>Core Tech (Pink dash + bars)</option>
          <option value="custom" {{ old('art_type') == 'custom' ? 'selected' : '' }}>Custom Geometric</option>
        </select>
      </div>

      <div class="form-group">
        <label for="period" class="form-label">Timeframe / Period</label>
        <input type="text" name="period" id="period" class="form-control" value="{{ old('period') }}" placeholder="09/2025 - 11/2025" />
      </div>

      <div class="form-group">
        <label for="role_type" class="form-label">Role Badge / Link Text</label>
        <input type="text" name="role_type" id="role_type" class="form-control" value="{{ old('role_type', 'UI/UX Design ↗') }}" placeholder="UI/UX Design ↗" />
      </div>
    </div>

    <div class="form-group">
      <label for="art_headline" class="form-label">Card Art Headline / Banner Text</label>
      <input type="text" name="art_headline" id="art_headline" class="form-control" value="{{ old('art_headline') }}" placeholder="e.g. Your money, in focus" />
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <div class="form-group">
        <label for="link" class="form-label">Live Link (URL)</label>
        <input type="text" name="link" id="link" class="form-control" value="{{ old('link', '#') }}" placeholder="https://..." />
      </div>

      <div class="form-group">
        <label for="sort_order" class="form-label">Display Order</label>
        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', 1) }}" />
      </div>
    </div>

    <div class="form-group" style="margin-top: 10px;">
      <label class="form-check" style="cursor: pointer;">
        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', 1) ? 'checked' : '' }}>
        <span style="font-size: 14px;">Publish & Feature on Landing Page</span>
      </label>
    </div>

    <div style="margin-top: 30px;">
      <button type="submit" class="btn btn-lime">Save Project ↗</button>
    </div>
  </form>
</div>
@endsection

