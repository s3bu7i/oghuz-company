@extends('layouts.admin')
@section('title','Xidməti Redaktə Et')
@section('content')
<div class="page-header">
  <h1>Xidməti Redaktə Et</h1>
  <a href="{{ route('admin.services.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Geri</a>
</div>
<form method="POST" action="{{ route('admin.services.update',$service) }}" enctype="multipart/form-data">
@csrf @method('PUT')
<div style="display:grid;grid-template-columns:1fr 300px;gap:1.5rem;align-items:start">
  <div class="card">
    <div class="form-group">
      <label class="form-label">Başlıq *</label>
      <input type="text" name="title" class="form-control" value="{{ old('title',$service->title) }}" required>
    </div>
    <div class="form-group">
      <label class="form-label">Qısa Təsvir *</label>
      <textarea name="short_description" class="form-control" rows="3" required>{{ old('short_description',$service->short_description) }}</textarea>
    </div>
    <div class="form-group">
      <label class="form-label">Ətraflı Təsvir</label>
      <textarea name="description" class="form-control" rows="6">{{ old('description',$service->description) }}</textarea>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">FontAwesome İkon</label>
        <input type="text" name="icon" class="form-control" value="{{ old('icon',$service->icon) }}">
      </div>
      <div class="form-group">
        <label class="form-label">Rəng (HEX)</label>
        <input type="text" name="color" class="form-control" value="{{ old('color',$service->color) }}">
      </div>
    </div>
  </div>
  <div style="display:flex;flex-direction:column;gap:1rem">
    <div class="card">
      <div class="form-group">
        <label class="form-label">Sıra</label>
        <input type="number" name="order" class="form-control" value="{{ old('order',$service->order) }}" min="1">
      </div>
      <div class="form-group">
        <label class="form-check"><input type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}> Aktiv</label>
      </div>
      <div class="form-group">
        <label class="form-check"><input type="checkbox" name="is_featured" value="1" {{ $service->is_featured ? 'checked' : '' }}> Öne Çıxarılmış</label>
      </div>
      <div class="form-group">
        <label class="form-label">Şəkil</label>
        @if($service->image)<img src="{{ Storage::url($service->image) }}" style="width:100%;border-radius:6px;margin-bottom:.5rem;max-height:120px;object-fit:cover" alt="">@endif
        <input type="file" name="image" class="form-control" accept="image/*">
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center"><i class="fas fa-save"></i> Yadda Saxla</button>
    </div>
  </div>
</div>
</form>
@endsection
