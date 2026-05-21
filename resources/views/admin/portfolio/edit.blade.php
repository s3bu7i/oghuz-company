@extends('layouts.admin')
@section('title','Layihəni Redaktə Et')
@section('content')
<div class="page-header">
  <h1>Layihəni Redaktə Et</h1>
  <a href="{{ route('admin.portfolio.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Geri</a>
</div>
<form method="POST" action="{{ route('admin.portfolio.update',$portfolio) }}" enctype="multipart/form-data">
@csrf @method('PUT')
<div style="display:grid;grid-template-columns:1fr 300px;gap:1.5rem;align-items:start">
  <div class="card">
    <div class="form-group">
      <label class="form-label">Layihə Adı *</label>
      <input type="text" name="title" class="form-control" value="{{ old('title',$portfolio->title) }}" required>
    </div>
    <div class="form-group">
      <label class="form-label">Təsvir *</label>
      <textarea name="description" class="form-control" rows="5" required>{{ old('description',$portfolio->description) }}</textarea>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Kateqoriya *</label>
        <input type="text" name="category" class="form-control" value="{{ old('category',$portfolio->category) }}" required>
      </div>
      <div class="form-group">
        <label class="form-label">Müştəri</label>
        <input type="text" name="client" class="form-control" value="{{ old('client',$portfolio->client) }}">
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">Texnologiyalar</label>
      <input type="text" name="technologies" class="form-control" value="{{ old('technologies',$portfolio->technologies) }}">
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">URL</label>
        <input type="url" name="url" class="form-control" value="{{ old('url',$portfolio->url) }}">
      </div>
      <div class="form-group">
        <label class="form-label">Tamamlanma Tarixi</label>
        <input type="date" name="completed_at" class="form-control" value="{{ old('completed_at', $portfolio->completed_at?->format('Y-m-d')) }}">
      </div>
    </div>
  </div>
  <div style="display:flex;flex-direction:column;gap:1rem">
    <div class="card">
      <div class="form-group">
        <label class="form-label">Sıra</label>
        <input type="number" name="order" class="form-control" value="{{ old('order',$portfolio->order) }}" min="1">
      </div>
      <div class="form-group">
        <label class="form-check"><input type="checkbox" name="is_active" value="1" {{ $portfolio->is_active ? 'checked' : '' }}> Aktiv</label>
      </div>
      <div class="form-group">
        <label class="form-check"><input type="checkbox" name="is_featured" value="1" {{ $portfolio->is_featured ? 'checked' : '' }}> Öne Çıxarılmış</label>
      </div>
      <div class="form-group">
        <label class="form-label">Şəkil</label>
        @if($portfolio->image)<img src="{{ Storage::url($portfolio->image) }}" style="width:100%;border-radius:6px;margin-bottom:.5rem;max-height:120px;object-fit:cover" alt="">@endif
        <input type="file" name="image" class="form-control" accept="image/*">
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center"><i class="fas fa-save"></i> Yadda Saxla</button>
    </div>
  </div>
</div>
</form>
@endsection
