@extends('layouts.app')
@section('title', __t('brand_name') . ' - ' . __t('site_tagline'))
@section('content')

<!-- Hero Section -->
<section class="hero">
  <div class="glow-bg glow-1"></div>
  <div class="glow-bg glow-2"></div>
  <div class="container">
    <div class="hero-content">
      <div class="hero-badge"><i class="fas fa-rocket"></i> {{ __t('home_badge') }}</div>
      <h1 class="hero-title">{{ __t('home_title_1') }} <br><span class="gradient">{{ __t('home_title_gradient') }}</span><br> {{ __t('home_title_2') }}</h1>
      <p class="hero-desc">{{ __t('site_tagline') }} {{ __t('home_desc_suffix') }}</p>
      <div class="hero-actions">
        <a href="{{ route('contact') }}" class="btn btn-primary"><i class="fas fa-paper-plane"></i> {{ __t('start_project') }}</a>
        <a href="{{ route('portfolio') }}" class="btn btn-outline"><i class="fas fa-briefcase"></i> {{ __t('view_work') }}</a>
      </div>
      <div class="hero-stats">
        <div class="stat-item"><div class="stat-num counter" data-target="{{ $stats['projects'] }}" data-suffix="+">0</div><div class="stat-label">{{ __t('stats_projects') }}</div></div>
        <div class="stat-item"><div class="stat-num counter" data-target="{{ $stats['clients'] }}" data-suffix="+">0</div><div class="stat-label">{{ __t('stats_clients') }}</div></div>
        <div class="stat-item"><div class="stat-num counter" data-target="{{ $stats['years'] }}" data-suffix="+">0</div><div class="stat-label">{{ __t('stats_years') }}</div></div>
      </div>
    </div>
  </div>
</section>

<!-- Services Section -->
<section class="section" style="background:var(--dark2)">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">{{ __t('what_we_do') }}</div>
      <h2 class="section-title">{!! __t('premium_services_title') !!}</h2>
      <p class="section-desc">{{ __t('premium_services_desc') }}</p>
    </div>
    <div class="grid-3">
      @foreach($services->take(6) as $s)
      <div class="card service-card">
        <div class="service-icon" style="background:{{ $s->color ?? '#00D4FF' }}15;color:{{ $s->color ?? '#00D4FF' }}"><i class="{{ $s->icon ?? 'fas fa-cog' }}"></i></div>
        <h3 class="service-title">{{ $s->title }}</h3>
        <p class="service-desc">{{ $s->short_description }}</p>
      </div>
      @endforeach
    </div>
    <div style="text-align:center;margin-top:3rem">
      <a href="{{ route('services') }}" class="btn btn-outline">{{ __t('all_services') }} <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- About Section -->
<section class="section" id="about">
  <div class="container">
    <div class="about-section">
      <div class="about-content">
        <div class="section-tag">{{ __t('about') }}</div>
        <h2 class="section-title">{!! __t('why_title') !!}</h2>
        <p style="color:var(--text-muted);font-size:1.05rem;line-height:1.8;margin-bottom:1.5rem">{{ __t('about_text') }}</p>
        <p style="color:var(--text-muted);font-size:1.05rem;line-height:1.8">{{ __t('about_text_2') }}</p>
        <div class="about-features">
          <div class="about-feat"><i class="fas fa-check-circle"></i> {{ __t('feature_security') }}</div>
          <div class="about-feat"><i class="fas fa-check-circle"></i> {{ __t('feature_delivery') }}</div>
          <div class="about-feat"><i class="fas fa-check-circle"></i> {{ __t('feature_support') }}</div>
          <div class="about-feat"><i class="fas fa-check-circle"></i> {{ __t('feature_design') }}</div>
        </div>
      </div>
      <div class="about-img-wrap">
        <div style="aspect-ratio:4/3;background:linear-gradient(135deg,rgba(0,212,255,.2),rgba(124,58,237,.2));border-radius:20px;border:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;font-size:5rem;color:rgba(255,255,255,.1)"><i class="fas fa-code"></i></div>
        <div class="about-badge">
          <div style="font-size:1.8rem">{{ $stats['years'] }}+</div>
          <div style="font-size:.75rem;font-weight:500;opacity:.8">{{ __t('stats_years') }}</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Portfolio Section -->
<section class="section" style="background:var(--dark2)">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">{{ __t('our_work') }}</div>
      <h2 class="section-title">{!! __t('latest_projects') !!}</h2>
    </div>
    <div class="grid-3">
      @foreach($portfolios as $p)
      <div class="portfolio-card">
        @if($p->image)<img src="{{ Storage::url($p->image) }}" class="portfolio-img" alt="{{ $p->title }}">
        @else<div style="width:100%;height:100%;background:linear-gradient(135deg,#1A1A2E,#0A0A0F);display:flex;align-items:center;justify-content:center;font-size:3rem;color:rgba(255,255,255,.05)"><i class="fas fa-briefcase"></i></div>@endif
        <div class="portfolio-overlay">
          <div class="portfolio-cat">{{ $p->category }}</div>
          <h3 class="portfolio-name">{{ $p->title }}</h3>
          <div class="portfolio-tech">{{ $p->technologies }}</div>
        </div>
      </div>
      @endforeach
    </div>
    <div style="text-align:center;margin-top:3rem">
      <a href="{{ route('portfolio') }}" class="btn btn-outline">{{ __t('all_projects') }} <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">{{ __t('testimonials') }}</div>
      <h2 class="section-title">{!! __t('testimonials_title') !!}</h2>
    </div>
    <div class="grid-3">
      @foreach($testimonials->take(3) as $t)
      <div class="card testimonial-card">
        <div class="stars">{{ str_repeat('★', $t->rating) }}</div>
        <p class="testimonial-text">"{{ $t->content }}"</p>
        <div class="testimonial-author">
          @if($t->avatar)<img src="{{ Storage::url($t->avatar) }}" class="author-avatar" alt="" style="object-fit:cover">
          @else<div class="author-avatar">{{ strtoupper(substr($t->name,0,1)) }}</div>@endif
          <div>
            <div class="author-name">{{ $t->name }}</div>
            <div class="author-meta">{{ $t->position }}, {{ $t->company }}</div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Blog Section -->
<section class="section" style="background:var(--dark2)">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">{{ __t('nav_blog') }}</div>
      <h2 class="section-title">{!! __t('latest_articles') !!}</h2>
    </div>
    <div class="grid-3">
      @foreach($posts as $post)
      <article class="blog-card-wrap">
        @if($post->image)<img src="{{ Storage::url($post->image) }}" class="blog-img" alt="">
        @else<div class="blog-img" style="display:flex;align-items:center;justify-content:center;font-size:3rem;color:rgba(255,255,255,.05)"><i class="fas fa-newspaper"></i></div>@endif
        <div class="blog-body">
          <div class="blog-cat">{{ $post->category }}</div>
          <h3 class="blog-title"><a href="{{ route('blog.post',$post->slug) }}">{{ $post->title }}</a></h3>
          <p class="blog-excerpt">{{ Str::limit($post->excerpt ?: strip_tags($post->content), 80) }}</p>
          <div class="blog-meta">
            <span><i class="far fa-calendar"></i> {{ $post->created_at->format('d M, Y') }}</span>
            <span><i class="far fa-clock"></i> {{ $post->read_time }} {{ __t('read_minutes') }}</span>
          </div>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</section>
@endsection
