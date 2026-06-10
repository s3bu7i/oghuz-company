@extends('layouts.app')
@section('title', __t('nav_services') . ' - ' . __t('brand_name'))
@section('content')

<div class="page-hero">
  <div class="container">
    <h1>{{ __t('services_title') }}</h1>
    <p>{{ __t('services_subtitle') }}</p>
    <div class="breadcrumb">
      <a href="{{ route('home') }}">{{ __t('nav_home') }}</a> / <span>{{ __t('nav_services') }}</span>
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
    <h2 class="section-title" style="font-size:2.2rem;margin-bottom:1rem">{!! __t('services_cta_title') !!}</h2>
    <p class="section-desc" style="margin-bottom:2rem">{{ __t('services_cta_desc') }}</p>
    <a href="{{ route('contact') }}" class="btn btn-primary" style="padding:1rem 2.5rem;font-size:1.05rem">{{ __t('contact_us') }}</a>
  </div>
</section>
@endsection
