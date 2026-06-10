@extends('layouts.app')
@section('title', __('messages.nav_portfolio') . ' - OghuzTech')
@section('content')

<div class="page-hero">
  <div class="container">
    <h1>{{ __('messages.nav_portfolio') }}</h1>
    <p>{{ __('messages.portfolio_subtitle') }}</p>
    <div class="breadcrumb">
      <a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a> / <span>{{ __('messages.nav_portfolio') }}</span>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="portfolio-filter">
      <button class="filter-btn active" data-cat="all">{{ __('messages.all') }}</button>
      @foreach($categories as $cat)
        @if($cat)<button class="filter-btn" data-cat="{{ Str::slug($cat) }}">{{ $cat }}</button>@endif
      @endforeach
    </div>

    <div class="grid-3" id="portfolioGrid">
      @foreach($portfolios as $p)
      <div class="portfolio-card portfolio-item" data-cat="{{ Str::slug($p->category) }}">
        @if($p->image)<img src="{{ Storage::url($p->image) }}" class="portfolio-img" alt="{{ $p->title }}">
        @else<div style="width:100%;height:100%;background:linear-gradient(135deg,#1A1A2E,#0A0A0F);display:flex;align-items:center;justify-content:center;font-size:3rem;color:rgba(255,255,255,.05)"><i class="fas fa-briefcase"></i></div>@endif
        <div class="portfolio-overlay">
          <div class="portfolio-cat">{{ $p->category }}</div>
          <h3 class="portfolio-name">{{ $p->title }}</h3>
          <div class="portfolio-tech">{{ $p->technologies }}</div>
          @if($p->url)
            <a href="{{ $p->url }}" target="_blank" class="btn btn-outline btn-sm" style="margin-top:1rem;align-self:flex-start;padding:.4rem 1rem">{{ __('messages.view_project') }} <i class="fas fa-external-link-alt" style="font-size:.75rem"></i></a>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
