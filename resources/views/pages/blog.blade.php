@extends('layouts.app')
@section('title', __t('nav_blog') . ' - ' . __t('brand_name'))
@section('content')

<div class="page-hero">
  <div class="container">
    <h1>{{ __t('nav_blog') }}</h1>
    <p>{{ __t('blog_subtitle') }}</p>
    <div class="breadcrumb">
      <a href="{{ route('home') }}">{{ __t('nav_home') }}</a> / <span>{{ __t('nav_blog') }}</span>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="grid-3">
      @forelse($posts as $post)
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
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:4rem;background:rgba(255,255,255,.02);border-radius:20px;color:var(--text-muted)">
        <i class="fas fa-newspaper" style="font-size:3rem;margin-bottom:1rem;opacity:.5"></i>
        <h3>{{ __t('no_posts') }}</h3>
      </div>
      @endforelse
    </div>

    @if($posts->hasPages())
    <div class="pagination">
      {{ $posts->links() }}
    </div>
    @endif
  </div>
</section>
@endsection
