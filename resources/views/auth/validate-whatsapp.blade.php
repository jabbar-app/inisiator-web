@extends('templates.main')

@section('content')
  <div class="content-grid full">
    <div class="row mt-5">
      <div class="col-sm-12 col-md-6 mx-auto">
        <div class="widget-box">
          <h3 class="mb-2">Validate your WhatsApp</h3>
          <p>Please input the code we're sent to your WhatsApp {{ $whatsapp }} below:</p>
          <div class="widget-box-content">
            <form action="{{ route('verify.whatsapp', $whatsapp) }}" method="POST" class="form"
              onsubmit="return validateWhatsAppNumber()">
              @csrf

              <div class="form-item mb-4">
                <div class="form-input small">
                  <label for="code">Confirmation Code</label>
                  <input type="text" id="code" name="code" value="{{ old('code') }}" required autofocus
                    oninput="validateNumberInput(this)">
                  @error('code')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <div class="d-flex justify-content-between align-items-center">
                <div class="">
                  <p>Wrong number? <a href="{{ route('play.dare.create', $whatsapp) }}">Edit here</a></p>
                </div>
                <button type="submit" class="button primary w-auto px-5">Verify</button>
              </div>
            </form>

          </div>
        </div>

        <div class="mt-4">
          @include('components.adsense-responsive')
        </div>
      </div>
    </div>
  </div>
@endsection
