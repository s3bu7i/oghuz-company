@extends('layouts.app')
@section('title', __('messages.contact_title') . ' - OghuzTech')
@section('content')

<div class="page-hero">
  <div class="container">
    <h1>{{ __('messages.contact_title') }}</h1>
    <p>{{ __('messages.contact_subtitle') }}</p>
    <div class="breadcrumb">
      <a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a> / <span>{{ __('messages.contact_title') }}</span>
    </div>
  </div>
</div>

<section class="section" style="padding-top:2rem">
  <div class="container">
    <div class="grid-2">
      <!-- Contact Info -->
      <div style="padding-right:2rem">
        <h2 style="font-size:2rem;font-weight:800;margin-bottom:1rem">{!! __('messages.contact_heading') !!}</h2>
        <p style="color:var(--text-muted);font-size:1.05rem;line-height:1.8;margin-bottom:2.5rem">{{ __('messages.contact_intro') }}</p>

        <div class="contact-info">
          <div class="contact-item">
            <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
            <div>
              <div class="contact-label">{{ __('messages.phone') }}</div>
              <div class="contact-value"><a href="tel:{{ str_replace(' ','', \App\Models\Setting::get('site_phone')) }}">{{ \App\Models\Setting::get('site_phone') }}</a></div>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
            <div>
              <div class="contact-label">{{ __('messages.email') }}</div>
              <div class="contact-value"><a href="mailto:{{ \App\Models\Setting::get('site_email') }}">{{ \App\Models\Setting::get('site_email') }}</a></div>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div>
              <div class="contact-label">{{ __('messages.address') }}</div>
              <div class="contact-value">{{ \App\Models\Setting::get('site_address') }}</div>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon"><i class="fas fa-clock"></i></div>
            <div>
              <div class="contact-label">{{ __('messages.work_hours') }}</div>
              <div class="contact-value">{{ __('messages.work_hours_value') }}</div>
            </div>
          </div>
        </div>

        <div style="margin-top:3rem">
          <div class="contact-label" style="margin-bottom:1rem">{{ __('messages.social_networks') }}</div>
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
        <form id="contactForm" class="contact-form" action="{{ route('contact.send') }}" method="POST" data-sending="{{ __('messages.sending') }}" data-error="{{ __('messages.error') }}">
          @csrf
          <h3 style="font-size:1.4rem;font-weight:700;margin-bottom:1.5rem">{{ __('messages.write_us') }}</h3>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">{{ __('messages.full_name') }}</label>
              <input type="text" name="name" class="form-control" required placeholder="{{ __('messages.full_name_placeholder') }}">
            </div>
            <div class="form-group">
              <label class="form-label">{{ __('messages.email_address') }}</label>
              <input type="email" name="email" class="form-control" required placeholder="{{ __('messages.email_placeholder') }}">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">{{ __('messages.phone_number') }}</label>
              <input type="text" name="phone" class="form-control" placeholder="+994 50 123 45 67">
            </div>
            <div class="form-group">
              <label class="form-label">{{ __('messages.subject') }}</label>
              <input type="text" name="subject" class="form-control" placeholder="{{ __('messages.subject_placeholder') }}">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">{{ __('messages.interested_service') }}</label>
            <select name="service" class="form-control" style="background-color:rgba(255,255,255,.05);color:var(--text);appearance:none">
              <option value="" style="background:var(--dark)">{{ __('messages.select_service') }}</option>
              @foreach($services as $s)
                <option value="{{ $s->title }}" style="background:var(--dark)">{{ $s->title }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">{{ __('messages.message') }}</label>
            <textarea name="message" class="form-control" rows="5" required placeholder="{{ __('messages.message_placeholder') }}"></textarea>
          </div>

          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:1rem;font-size:1rem;margin-top:.5rem">
            <i class="fas fa-paper-plane"></i> {{ __('messages.send_message') }}
          </button>
          <div style="font-size:.75rem;color:var(--text-muted);text-align:center;margin-top:1rem">
            {{ __('messages.privacy_note') }}
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
