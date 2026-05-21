@extends('layouts.admin')
@section('title','Parametrlər')
@section('content')
<div class="page-header">
  <h1>Sayt Parametrləri</h1>
</div>
<form method="POST" action="{{ route('admin.settings.update') }}">
@csrf
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;align-items:start">

  <!-- General Settings -->
  <div class="card">
    <div class="card-title mb-2"><i class="fas fa-globe text-primary"></i> Ümumi Parametrlər</div>
    @foreach($settings['general'] ?? [] as $s)
    <div class="form-group">
      <label class="form-label" style="text-transform:capitalize">{{ str_replace('_',' ',$s->key) }}</label>
      <input type="text" name="{{ $s->key }}" class="form-control" value="{{ $s->value }}">
    </div>
    @endforeach
  </div>

  <!-- Contact Settings -->
  <div class="card">
    <div class="card-title mb-2"><i class="fas fa-address-book text-primary"></i> Əlaqə Məlumatları</div>
    @foreach($settings['contact'] ?? [] as $s)
    <div class="form-group">
      <label class="form-label" style="text-transform:capitalize">{{ str_replace('_',' ',$s->key) }}</label>
      <input type="text" name="{{ $s->key }}" class="form-control" value="{{ $s->value }}">
    </div>
    @endforeach
  </div>

  <!-- Social Settings -->
  <div class="card">
    <div class="card-title mb-2"><i class="fas fa-share-nodes text-primary"></i> Sosial Şəbəkələr</div>
    @foreach($settings['social'] ?? [] as $s)
    <div class="form-group">
      <label class="form-label" style="text-transform:capitalize">{{ $s->key }}</label>
      <input type="text" name="{{ $s->key }}" class="form-control" value="{{ $s->value }}">
    </div>
    @endforeach
  </div>

  <!-- About Settings -->
  <div class="card">
    <div class="card-title mb-2"><i class="fas fa-building text-primary"></i> Haqqımızda</div>
    @foreach($settings['about'] ?? [] as $s)
    <div class="form-group">
      <label class="form-label" style="text-transform:capitalize">{{ str_replace('_',' ',$s->key) }}</label>
      <textarea name="{{ $s->key }}" class="form-control" rows="4">{{ $s->value }}</textarea>
    </div>
    @endforeach
  </div>

</div>
<div style="margin-top:2rem;text-align:right">
  <button type="submit" class="btn btn-primary" style="padding:.75rem 2.5rem;font-size:1rem"><i class="fas fa-save"></i> Dəyişiklikləri Yadda Saxla</button>
</div>
</form>
@endsection
