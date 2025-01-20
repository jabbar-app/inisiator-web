@extends('layouts.app')

@section('content')
  <main id="content">
    <div class="content-widget">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <form action="{{ route('pages.send-request-invitation') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <!-- Nama Lengkap -->
              <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="name" id="name"
                  class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Lengkap"
                  value="{{ old('name') }}" required>
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <!-- No. WhatsApp -->
              <div class="mb-3">
                <label for="phone" class="form-label fw-semibold">No. WhatsApp</label>
                <input type="text" name="phone" id="phone"
                  class="form-control @error('phone') is-invalid @enderror" placeholder="62xxxxxxxxxxx"
                  value="{{ old('phone') }}" pattern="^62[1-9][0-9]{8,15}$"
                  title="Nomor harus diawali 62 dan terdiri dari 10-15 digit" required>
                @error('phone')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" name="email" id="email"
                  class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email"
                  value="{{ old('email') }}" required>
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <!-- Upload Sampel Tulisan -->
              <div class="mb-3">
                <label for="sample_article" class="form-label fw-semibold">Upload Sampel Tulisan</label>
                <input type="file" name="sample_article" id="sample_article"
                  class="form-control @error('sample_article') is-invalid @enderror" accept=".pdf,.doc,.docx,.txt"
                  required>
                @error('sample_article')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <!-- Submit Button -->
              <center>
                <button type="submit" class="btn btn-primary">Request Undangan</button>
              </center>
            </form>

          </div>
        </div>
      </div> <!--content-widget-->
    </div>

    <div class="content-widget">
      <div class="container">
        <div class="sidebar-widget ads">
          @include('components.adsense-responsive')
        </div>
        <div class="hr"></div>
      </div>
    </div>
  </main>
@endsection
