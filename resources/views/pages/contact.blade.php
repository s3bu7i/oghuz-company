@extends('layouts.app')
@section('title', __t('contact_title') . ' - ' . __t('brand_name'))
@section('content')

<div class="page-hero">
  <div class="container">
    <h1>{{ __t('contact_title') }}</h1>
    <p>{{ __t('contact_subtitle') }}</p>
    <div class="breadcrumb">
      <a href="{{ route('home') }}">{{ __t('nav_home') }}</a> / <span>{{ __t('contact_title') }}</span>
    </div>
  </div>
</div>

<section class="section" style="padding-top:2rem">
  <div class="container">
    <div class="grid-2">
      <!-- Contact Info -->
      <div style="padding-right:2rem">
        <h2 style="font-size:2rem;font-weight:800;margin-bottom:1rem">{!! __t('contact_heading') !!}</h2>
        <p style="color:var(--text-muted);font-size:1.05rem;line-height:1.8;margin-bottom:2.5rem">{{ __t('contact_intro') }}</p>

        <div class="contact-info">
          <div class="contact-item">
            <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
            <div>
              <div class="contact-label">{{ __t('phone') }}</div>
              <div class="contact-value"><a href="tel:{{ str_replace(' ','', \App\Models\Setting::get('site_phone')) }}">{{ \App\Models\Setting::get('site_phone') }}</a></div>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
            <div>
              <div class="contact-label">{{ __t('email') }}</div>
              <div class="contact-value"><a href="mailto:{{ \App\Models\Setting::get('site_email') }}">{{ \App\Models\Setting::get('site_email') }}</a></div>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div>
              <div class="contact-label">{{ __t('address') }}</div>
              <div class="contact-value">{{ \App\Models\Setting::get('site_address') }}</div>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon"><i class="fas fa-clock"></i></div>
            <div>
              <div class="contact-label">{{ __t('work_hours') }}</div>
              <div class="contact-value">{{ __t('work_hours_value') }}</div>
            </div>
          </div>
        </div>

        <div style="margin-top:3rem">
          <div class="contact-label" style="margin-bottom:1rem">{{ __t('social_networks') }}</div>
          <div class="social-links">
            @if(\App\Models\Setting::get('facebook'))<a href="{{ \App\Models\Setting::get('facebook') }}" target="_blank"><i class="fab fa-facebook-f"></i></a>@endif
            @if(\App\Models\Setting::get('linkedin'))<a href="{{ \App\Models\Setting::get('linkedin') }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>@endif
            @if(\App\Models\Setting::get('instagram'))<a href="{{ \App\Models\Setting::get('instagram') }}" target="_blank"><i class="fab fa-instagram"></i></a>@endif
            @if(\App\Models\Setting::get('twitter'))<a href="{{ \App\Models\Setting::get('twitter') }}" target="_blank"><i class="fab fa-twitter"></i></a>@endif
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div>
        <form id="contactForm" class="contact-form" action="{{ route('contact.send') }}" method="POST" data-sending="{{ __t('sending') }}" data-error="{{ __t('error') }}">
          @csrf
          <h3 style="font-size:1.4rem;font-weight:700;margin-bottom:1.5rem">{{ __t('write_us') }}</h3>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">{{ __t('full_name') }}</label>
              <input type="text" name="name" class="form-control" required placeholder="{{ __t('full_name_placeholder') }}">
            </div>
            <div class="form-group">
              <label class="form-label">{{ __t('email_address') }}</label>
              <input type="email" name="email" class="form-control" required placeholder="{{ __t('email_placeholder') }}">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">{{ __t('phone_number') }}</label>
              <input type="text" name="phone" class="form-control" placeholder="+994 50 123 45 67">
            </div>
            <div class="form-group">
              <label class="form-label">{{ __t('subject') }}</label>
              <input type="text" name="subject" class="form-control" placeholder="{{ __t('subject_placeholder') }}">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">{{ __t('interested_service') }}</label>
            <select name="service" class="form-control" style="background-color:rgba(255,255,255,.05);color:var(--text);appearance:none">
              <option value="" style="background:var(--dark)">{{ __t('select_service') }}</option>
              @foreach($services as $s)
                <option value="{{ $s->title }}" style="background:var(--dark)">{{ $s->title }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">{{ __t('message') }}</label>
            <textarea name="message" class="form-control" rows="5" required placeholder="{{ __t('message_placeholder') }}"></textarea>
          </div>

          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:1rem;font-size:1rem;margin-top:.5rem">
            <i class="fas fa-paper-plane"></i> {{ __t('send_message') }}
          </button>
          <div style="font-size:.75rem;color:var(--text-muted);text-align:center;margin-top:1rem">
            {{ __t('privacy_note') }}
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
