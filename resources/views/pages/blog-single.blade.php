@extends('layouts.app')
@section('title', $post->title . ' - Blog')
@section('content')

<div style="padding-top:100px;background:linear-gradient(to bottom,rgba(0,212,255,.05),transparent);border-bottom:1px solid rgba(255,255,255,.05)">
  <div class="container" style="max-width:900px">
    <div style="padding:4rem 0 2rem;text-align:center">
      <div class="section-tag" style="margin-bottom:1.5rem">{{ $post->category }}</div>
      <h1 style="font-size:clamp(1.8rem,5vw,3rem);font-weight:800;margin-bottom:1.5rem;line-height:1.3">{{ $post->title }}</h1>
      <div style="display:flex;align-items:center;justify-content:center;gap:2rem;color:var(--text-muted);font-size:.95rem">
        <span style="display:flex;align-items:center;gap:.5rem"><i class="fas fa-user-edit" style="color:var(--primary)"></i> {{ $post->author }}</span>
        <span style="display:flex;align-items:center;gap:.5rem"><i class="far fa-calendar" style="color:var(--accent)"></i> {{ $post->created_at->format('d M, Y') }}</span>
        <span style="display:flex;align-items:center;gap:.5rem"><i class="far fa-eye" style="color:#22C55E"></i> {{ $post->views }} {{ __t('views') }}</span>
      </div>
    </div>
  </div>
</div>

<section class="section" style="padding-top:3rem">
  <div class="container" style="max-width:900px">
    <article class="blog-single">
      @if($post->image)
        <img src="{{ Storage::url($post->image) }}" class="blog-single-img" alt="{{ $post->title }}">
      @endif

      @if($post->excerpt)
        <div style="font-size:1.15rem;line-height:1.8;color:var(--text);font-style:italic;margin-bottom:2.5rem;padding-left:1.5rem;border-left:4px solid var(--primary)">
          {{ $post->excerpt }}
        </div>
      @endif

      <div class="blog-content">
        {!! $post->content !!}
      </div>

      <div style="margin-top:4rem;padding-top:2rem;border-top:1px solid var(--border);display:flex;justify-content:space-between;align-items:center">
        <a href="{{ route('blog') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> {{ __t('back_to_blog') }}</a>
        <div style="display:flex;gap:.75rem">
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-outline" style="padding:.5rem .75rem"><i class="fab fa-facebook-f"></i></a>
          <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-outline" style="padding:.5rem .75rem"><i class="fab fa-twitter"></i></a>
          <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($post->title) }}" target="_blank" class="btn btn-outline" style="padding:.5rem .75rem"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
    </article>
  </div>
</section>

@if($related->count() > 0)
<section class="section" style="background:var(--dark2);padding-top:4rem;padding-bottom:5rem">
  <div class="container">
    <h3 style="font-size:1.8rem;font-weight:700;margin-bottom:2.5rem;text-align:center">{!! __t('related_articles') !!}</h3>
    <div class="grid-3">
      @foreach($related as $r_post)
      <article class="blog-card-wrap">
        @if($r_post->image)<img src="{{ Storage::url($r_post->image) }}" class="blog-img" alt="">
        @else<div class="blog-img" style="display:flex;align-items:center;justify-content:center;font-size:3rem;color:rgba(255,255,255,.05)"><i class="fas fa-newspaper"></i></div>@endif
        <div class="blog-body">
          <div class="blog-cat">{{ $r_post->category }}</div>
          <h3 class="blog-title"><a href="{{ route('blog.post',$r_post->slug) }}">{{ $r_post->title }}</a></h3>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</section>
@endif
@endsection
