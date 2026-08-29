@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')
<div class="card-box" style="max-width: 800px;">
  <div class="card-header">
    <h2 class="card-title">Edit: {{ $project->title }}</h2>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary" style="font-size: 11px;">← Back to Projects</a>
  </div>

  <form action="{{ route('admin.projects.update', $project) }}" method="POST">
    @csrf
    @method('PUT')

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <div class="form-group">
        <label for="title" class="form-label">Project Title *</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $project->title) }}" required />
      </div>

      <div class="form-group">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $project->slug) }}" />
      </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <div class="form-group">
        <label for="subtitle" class="form-label">Subtitle</label>
        <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ old('subtitle', $project->subtitle) }}" />
      </div>

      <div class="form-group">
        <label for="category" class="form-label">Category</label>
        <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $project->category) }}" />
      </div>
    </div>

    <div class="form-group">
      <label for="description" class="form-label">Description *</label>
      <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $project->description) }}</textarea>
    </div>

    <div class="form-group">
      <label for="tags_string" class="form-label">Tags (comma separated)</label>
      @php
        $tagsString = is_array($project->tags) ? implode(', ', $project->tags) : '';
      @endphp
      <input type="text" name="tags_string" id="tags_string" class="form-control" value="{{ old('tags_string', $tagsString) }}" />
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
      <div class="form-group">
        <label for="art_type" class="form-label">Visual Art Badge *</label>
        <select name="art_type" id="art_type" class="form-control" required>
          <option value="tax" {{ old('art_type', $project->art_type) == 'tax' ? 'selected' : '' }}>Taxwale (Violet/Sky screen)</option>
          <option value="bhoomi" {{ old('art_type', $project->art_type) == 'bhoomi' ? 'selected' : '' }}>Bhoomija (Mint window + leaf)</option>
          <option value="core" {{ old('art_type', $project->art_type) == 'core' ? 'selected' : '' }}>Core Tech (Pink dash + bars)</option>
          <option value="custom" {{ old('art_type', $project->art_type) == 'custom' ? 'selected' : '' }}>Custom Geometric</option>
        </select>
      </div>

      <div class="form-group">
        <label for="period" class="form-label">Timeframe / Period</label>
        <input type="text" name="period" id="period" class="form-control" value="{{ old('period', $project->period) }}" />
      </div>

      <div class="form-group">
        <label for="role_type" class="form-label">Role Badge / Link Text</label>
        <input type="text" name="role_type" id="role_type" class="form-control" value="{{ old('role_type', $project->role_type) }}" />
      </div>
    </div>

    <div class="form-group">
      <label for="art_headline" class="form-label">Card Art Headline / Banner Text</label>
      <input type="text" name="art_headline" id="art_headline" class="form-control" value="{{ old('art_headline', $project->art_headline) }}" />
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <div class="form-group">
        <label for="link" class="form-label">Live Link (URL)</label>
        <input type="text" name="link" id="link" class="form-control" value="{{ old('link', $project->link) }}" />
      </div>

      <div class="form-group">
        <label for="sort_order" class="form-label">Display Order</label>
        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $project->sort_order) }}" />
      </div>
    </div>

    <div class="form-group" style="margin-top: 10px;">
      <label class="form-check" style="cursor: pointer;">
        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
        <span style="font-size: 14px;">Publish & Feature on Landing Page</span>
      </label>
    </div>

    <div style="margin-top: 30px;">
      <button type="submit" class="btn btn-lime">Update Project ↗</button>
    </div>
  </form>
</div>
@endsection

