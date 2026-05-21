@extends('layouts.app')
@section('title', 'Xidmətlər — ' . \App\Models\Setting::get('site_name'))
@section('content')

<div class="page-hero">
  <div class="container">
    <h1>Xidmətlərimiz</h1>
    <p>Biznesinizin rəqəmsal transformasiyası üçün təklif etdiyimiz həllər</p>
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Ana Səhifə</a> / <span>Xidmətlər</span>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="grid-3">
      @foreach($services as $s)
      <div class="card service-card">
        <div class="service-icon" style="background:{{ $s->color ?? '#00D4FF' }}15;color:{{ $s->color ?? '#00D4FF' }}"><i class="{{ $s->icon ?? 'fas fa-cog' }}"></i></div>
        <h3 class="service-title">{{ $s->title }}</h3>
        <p class="service-desc">{{ $s->description ?: $s->short_description }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Call to action -->
<section class="section" style="background:linear-gradient(135deg,rgba(0,212,255,.05),rgba(124,58,237,.05));text-align:center">
  <div class="container">
    <h2 class="section-title" style="font-size:2.2rem;margin-bottom:1rem">Layihənizi <span>Bizimlə</span> Başlayın</h2>
    <p class="section-desc" style="margin-bottom:2rem">Peşəkar komandamız sizin ideyalarınızı reallığa çevirməyə hazırdır.</p>
    <a href="{{ route('contact') }}" class="btn btn-primary" style="padding:1rem 2.5rem;font-size:1.05rem">Bizimlə Əlaqə</a>
  </div>
</section>
@endsection
